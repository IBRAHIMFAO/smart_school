<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seance;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class PublicTimeTableController extends Controller
{
            // Show the student's timetable
            public function index(Request $request)
            {
                // Get the authenticated student user
                $user = auth()->user();

                // Retrieve the group ID to which the student belongs
                $groupId = $user->student->code_group;
                $group = Group::find($groupId);



                // Fetch seances that belong to the student's group
                $seances = Seance::with(['prof', 'matiere', 'salle', 'group'])->where('code_group', $groupId)->get();

                // Generate days of the week and time intervals
                $daysOfWeek = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
                $timeIntervals = [
                    '08:00:00 - 09:00:00',
                    '09:00:00 - 10:00:00',
                    '10:00:00 - 11:00:00',
                    '11:00:00 - 12:00:00',
                    '12:00:00 - 13:00:00',
                    '13:00:00 - 14:00:00',
                    '14:00:00 - 15:00:00',
                    '15:00:00 - 16:00:00',
                    '16:00:00 - 17:00:00',
                    '17:00:00 - 18:00:00',
                    '18:00:00 - 18:30:00',
                ];

                // Filter seances based on the selected week    $chosenWeek
                // $chosenWeek = request()->input('week', 1);
                 // Filter seances based on the selected week
                $chosenWeek = $request->get('chosen_week', 1); // Default to week 1 if not provided

                    // Get the chosen week from the request or set a default value
                    $chosenWeek = $request->input('week', 1);


                $filteredSeances = $this->filterSeancesByWeek($seances, $chosenWeek , $groupId);
                // dd($filteredSeances);

                // return view('student-pub.timetable', compact('group', 'pic_mdlnational', 'pic', 'chosenGroup', 'filteredSeances', 'chosenWeek', 'timeIntervals', 'daysOfWeek'));
                return view('student-pub.timetable', compact('group','filteredSeances', 'chosenWeek', 'timeIntervals', 'daysOfWeek'));

            }

            // Filter seances based on the selected week
            private function filterSeancesByWeek($seances, $weekNumber ,$groupId )
            {
                $filteredSeances = [];

                foreach ($seances as $seance) {
                    $dayOfWeek = (Carbon::parse($seance->date)->dayOfWeek + 6) % 7;
                    $seanceDate = Carbon::parse($seance->date);
                    $startOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->startOfWeek();
                    $endOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->endOfWeek();

                    $intervalIndex = $this->getIntervalIndex($seance->heure_debut);

                    if (
                        $seanceDate->isBetween($startOfWeek, $endOfWeek) &&
                        $seance->code_group == $groupId
                    ) {
                        $filteredSeances[$dayOfWeek][$intervalIndex][] = $seance;
                    }
                }

                return $filteredSeances;
            }

            // Get the interval index based on the seance's start time
            private function getIntervalIndex($time)
            {
               
                $time = Carbon::parse($time)->format('H:i:s');

                $intervalIndexMap = [
                    '08:00:00' => 0,
                    '09:00:00' => 1,
                    '10:00:00' => 2,
                    '11:00:00' => 3,
                    '12:00:00' => 4,
                    '13:00:00' => 5,
                    '14:00:00' => 6,
                    '15:00:00' => 7,
                    '16:00:00' => 8,
                    '17:00:00' => 9,
                    '18:00:00' => 10,
                    '18:30:00' => 11,
                ];

                return isset($intervalIndexMap[$time]) ? $intervalIndexMap[$time] : null;
            }

}
