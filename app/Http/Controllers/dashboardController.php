<?php

namespace App\Http\Controllers;
use App\Models\Seance;
use App\Models\Attendance;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Group;
use App\Models\Niveauxscolaire;
use App\Models\Prof;
use App\Models\Salle;
use App\Models\Student;
use App\Models\Ecole;
use App\Models\User;
use App\Models\Pavilion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class dashboardController extends Controller
{


    public function index()
    {
        $seances=Seance::select('*')->orderBy("id","ASC")->get();
        $students=Student::all()->count();
        $salles =Salle::all()->count();
        $totalprofs=Prof::all()->count();
        $totalgroups=Group::all()->count();
        $groups=Group::all();
        $niveuxscolaires=Niveauxscolaire::all();
        
        

        $currentDateTime = Carbon::now();
        $seancetime = Seance::with('group') // Eager load the 'group' relationship
        ->where('heure_debut', '<=', $currentDateTime)
        ->where('heure_fin', '>=', $currentDateTime)
        ->first();

            // Filter the seances based on the condition and order them by date and time
        $seancesToDo = $seances->filter(function ($seance) use ($currentDateTime) {
            return Carbon::parse($seance->date . ' ' . $seance->heure_debut->format('H:i:s'))->lte($currentDateTime);

            // dd($seance->date . ' ' . $seance->heure_debut);
            

        })->sortBy(function ($seance) { // Sort the seances by date and time in descending order bach 3kssna order dyal list
            return Carbon::parse($seance->date . ' ' . $seance->heure_debut->format('H:i:s'))->timestamp * -1;
        });

        // sortBy(['date' => 'asc', 'heure_debut' => 'asc']);





                    $groups = Group::select('groups.id', 'groups.nom_group')
                    ->leftJoin('seances', 'groups.id', '=', 'seances.code_group')
                    ->leftJoin('attendances', 'seances.id', '=', 'attendances.code_seance')
                    // ->selectRaw('groups.id AS group_id, groups.nom_group, MONTH(attendances.date) AS month, COUNT(*) AS count, attendances.status')
                    ->selectRaw('groups.id AS group_id, groups.nom_group, MONTH(attendances.created_at) AS month, COUNT(*) AS count, attendances.status')

                    // ->whereYear('attendances.date', now()->year)
                    ->whereYear('attendances.created_at', now()->year)
                    // ->whereNotNull('attendances.date')
                    // ->whereNotNull('attendances.date(created_at)')
                    ->whereNotNull(DB::raw('DATE(attendances.created_at)'))
                    ->whereNotNull('seances.id')
                    ->whereIn('attendances.status', ['absent', 'present', 'tardy'])
                    ->groupBy('group_id', 'groups.nom_group', 'month', 'attendances.status')
                    ->get();


                $groupData = [];
                foreach ($groups as $group) {
                    $groupId = $group->group_id;
                    $status = $group->status;

                    if (!isset($groupData[$groupId])) {
                        $groupData[$groupId] = [
                            'label' => $group->nom_group,
                            'data' => [
                                'absent' => array_fill(0, 12, 0),
                                'present' => array_fill(0, 12, 0),
                                'tardy' => array_fill(0, 12, 0),
                            ]

                        ];
                    }

                    $month = $group->month;
                    $count = $group->count;

                    $groupData[$groupId]['data'][$status][$month-1] = $count;
                }

                $data = array_values($groupData);



            //    dd($presenceRate,$absenceRate);





             //################## case= absences  code khdam ###########################################################

                          $groupsa = Group::select('groups.id', 'groups.nom_group')
                    ->leftJoin('seances', 'groups.id', '=', 'seances.code_group')
                    ->leftJoin('attendances', 'seances.id', '=', 'attendances.code_seance')
                    // ->selectRaw('groups.id AS group_id, COUNT(*) AS absences_count, MONTH(attendances.date) AS month')
                    ->selectRaw('groups.id AS group_id, COUNT(*) AS absences_count, MONTH(attendances.created_at) AS month')

                    // ->whereYear('attendances.date', now()->year)
                    ->whereYear('attendances.created_at', now()->year)

                    // ->whereNotNull('attendances.date')
                    ->whereNotNull(DB::raw('DATE(attendances.created_at)'))
                    ->whereNotNull('seances.id')
                    ->whereIn('attendances.status',['absent'])
                    ->groupBy('groups.id', 'groups.nom_group','month')
                    ->get();


                     $groupData = [];
                    foreach ($groupsa as $group) {
                        $groupId = $group->group_id;

                        if (!isset($groupData[$groupId])) {
                            $groupData[$groupId] = [
                                'label' => $group->nom_group,
                                // 'data' => array_fill(0, 12, 0) // Initialize data array with zeros for all months
                                'data' => [
                                    'absent' => array_fill(0, 12, 0)
                                ]
                            ];
                        }

                        $month = $group->month;
                        $absencesCount = $group->absences_count;

                        $groupData[$groupId]['data']['absent'][$month - 1] = $absencesCount;
                    }

                    $datag = array_values($groupData);
                       ##################################for status = absence  code khdam ###############
                    //    dd($datag);
                //#############################################################################



    return view('dashcontent', compact('seances','totalprofs','seancetime','data','datag','students','salles','totalgroups','seancesToDo','niveuxscolaires'));

####################################################################################################################




                   // $data = [];
                // foreach ($groups as $group) {
                //     $groupData = [
                //         'label' => $group->nom_group,
                //         'data' => []
                //     ];

                //     for ($month = 1; $month <= 12; $month++) {
                //         $absencesCount = $groups->where('group_id', $group->group_id)
                //             ->where('month', $month)
                //             ->sum('absences_count');

                //         $groupData['data'][] = $absencesCount;
                //     }

                //     $data[] = $groupData;}









            // dd($absences);
        //  dd($totalprofs);
    }


}
