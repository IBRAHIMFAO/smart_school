<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Exports\EmploiDuTempsProfExport;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Group;
use App\Models\Seance;
use App\Models\Prof;
use Carbon\Carbon;
use App\Models\Departement;


class EmploiDuTempsProfController extends Controller
{
    public function index(Request $request)
    {
        // Get all professors
        $profs = Prof::all();
        $departements=Departement::All();

        // Get all seances
        $seances = Seance::with(['prof', 'matiere', 'salle', 'group'])->get();

        // Generate days of the week
        $daysOfWeek = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];

        // Generate time intervals (adjust as needed)
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
            '18:00:00 - 18:30:00'
        ];
        // Get the chosen week and professor from the request
        $chosenWeek = $request->input('week', 1);
        $chosenProfId = $request->input('chosen_prof');

        // Filter seances based on the chosen week and professor
        $filteredSeances = $this->filterSeancesByWeekAndProf($seances, $chosenWeek, $chosenProfId);



        // Export to Excel if the export button was clicked
        if ($request->has('export')) {
            return Excel::download(new EmploiDuTempsProfExport, 'emploi_du_temps_prof.xlsx');
        }


        return view('emploi-du-temps.prof', compact('profs','departements' ,'daysOfWeek', 'timeIntervals', 'filteredSeances', 'chosenWeek', 'chosenProfId'));
    }

    private function filterSeancesByWeekAndProf($seances, $weekNumber, $chosenProfId)
    {
        $filteredSeances = [];

        foreach ($seances as $seance) {
            $dayOfWeek = (Carbon::parse($seance->date)->dayOfWeek + 6) % 7;

            // Convert the date attribute to a Carbon instance
            $seanceDate = Carbon::parse($seance->date);

            $startOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->startOfWeek();
            $endOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->endOfWeek();

            // Calculate the interval index based on the seance's start time
            $intervalIndex = $this->getIntervalIndex($seance->heure_debut);
            // Check if the seance's date is within the selected week and matches the chosen professor
            if (
                $seanceDate->isBetween($startOfWeek, $endOfWeek) &&
                (!$chosenProfId || $seance->code_prof == $chosenProfId)
            ) {
                  // Calculate session duration
                  $sessionDuration = Carbon::parse($seance->heure_debut)->diffInHours($seance->heure_fin);

                  // Add the seance to the appropriate rows based on duration
                  for ($i = 0; $i < $sessionDuration; $i++) {
                      $filteredSeances[$dayOfWeek][$intervalIndex + $i][] = $seance;
                  }
            }
        }

        return $filteredSeances;
    }


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





public function downloadPdf(Request $request)
{

    // dd($request->all());


    $chosenWeek = $request->input('chosenWeek');
    // $seanceColor = $request->input('seanceColor');
    $chosenProfId = $request->input('chosenProfId');


    $seances = Seance::with(['prof', 'matiere', 'group'])->get();


    $filteredSeances = $this->filterSeancesByWeekAndProf($seances, $chosenWeek, $chosenProfId);



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
            '18:00:00 - 18:30:00'
        ];

        // $ecole = $salle->seance->group->niveauxscolaire->filiere->departement->ecole;

        $prof = Prof::find($chosenProfId);
        $ecoles = []; // An array to store ecole instances

        // $ecole=$prof->departements->ecole;

        if ($prof) {
        foreach ($prof->seances as $seance) {
            $group = $seance->group;
            $niveauxScolaire = $group->niveauxscolaire;
            $filiere = $niveauxScolaire->filiere;
            $departement = $filiere->departement;
            $ecole = $departement->ecole;

            // Store each $ecole in an array if necessary
            $ecoles[] = $ecole;
        }
    }
    //     Now you have an array of ecole instances

            // $path = public_path('storage/' . $ecole->logo);
            // if (file_exists($path)) {
            //     $type = pathinfo($path, PATHINFO_EXTENSION);

            //     $data = file_get_contents($path);

            //     $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // }


            // $path_mdlnational = public_path('storage/logos/mdlnationale.png');
            // if (file_exists($path_mdlnational)) {
            //     $type_mdlnational = pathinfo($path_mdlnational, PATHINFO_EXTENSION);
            //     $data_mdlnational = file_get_contents($path_mdlnational);
            //     $pic_mdlnational = 'data:image/' . $type_mdlnational . ';base64,' . base64_encode($data_mdlnational);
            // } else {
            //     $pic_mdlnational = ''; // Set it to an empty string if the file does not exist
            // }

            // Modify your code to set the page size and orientation
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('emploi-du-temps.pdf-prof', compact('ecole','prof','chosenProfId', 'filteredSeances', 'chosenWeek', 'timeIntervals', 'daysOfWeek'))
            ->setPaper('a4', 'landscape') // Set the page size to A4 and landscape orientation
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

            return $pdf->stream('prof.pdf');


}

















    public function getProfByDepartment(Request $request)
    {
        $departmentId = $request->input('department_id');

        // Fetch professors belonging to the selected department
        $professors = Prof::whereHas('departements', function ($query) use ($departmentId) {
            $query->where('code_departement', $departmentId);
        })->get();

        return response()->json($professors);
    }



}
