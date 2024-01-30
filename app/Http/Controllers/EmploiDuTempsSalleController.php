<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;
use App\Models\Group;
use App\Models\Seance;
use Carbon\Carbon;
use App\Models\AnneeScolaire;
use App\Models\Pavilion;
use PDF ;



class EmploiDuTempsSalleController extends Controller
{


    public function index(Request $request)
    {
        $pavilions= Pavilion::all();
        $anneeScolaires=AnneeScolaire::all();

        // Get all salles
        $salles = Salle::all();

        // Capture the selected salle from the form input
        $selectedSalleId = $request->input('salle');
        $selectedSalle = Salle::find($selectedSalleId);

        // Get all seances
        $seances = Seance::with(['prof', 'matiere', 'group'])->get();

        // Generate days of the week
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

        // Filter seances based on the selected week
        $chosenWeek = $request->get('chosen_week', 1); // Default to week 1 if not provided

        // Get the chosen week from the request or set a default value
        $chosenWeek = $request->input('week', 1);

        // Récupérer la salle sélectionnée depuis la requête
        $chosenSalle = $request->input('chosen_salle');

        // ###########################################################


        // ##############################################################

        // Filter seances based on the chosen week and salle
        $filteredSeances = $this->filterSeancesByWeekAndSalle($seances, $chosenWeek, $chosenSalle);
        // dd($filteredSeances);
        // dd($seances);

        // List of predefined colors
        $colors = [
            '#E57373', '#F06292', '#BA68C8', '#9575CD', '#7986CB',
            '#64B5F6', '#4FC3F7', '#4DD0E1', '#4DB6AC', '#81C784',
            '#AED581', '#DCE775', '#FFF176', '#FFD54F', '#FFB74D',
            '#FF8A65', '#A1887F', '#90A4AE', '#B0BEC5', '#000000',
            '#B71C1C', '#880E4F', '#311B92', '#1A237E', '#0D47A1',
        ];

        // Retrieve the last used color index from the session or initialize it to 0
        $lastColorIndex = $request->session()->get('lastColorIndex', 0);

        // Initialize the color map
        $colorMap = [];


        return view('emploi-du-temps.salle', compact('seances','salles', 'chosenSalle', 'daysOfWeek', 'timeIntervals', 'filteredSeances',
         'chosenWeek', 'selectedSalle', 'colors', 'lastColorIndex', 'colorMap', 'pavilions', 'anneeScolaires'  ));
    }

    private function filterSeancesByWeekAndSalle($seances, $weekNumber, $chosenSalle)
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

            // Check if the seance's date is within the selected week and matches the chosen salle
            if (
                $seanceDate->isBetween($startOfWeek, $endOfWeek) &&
                (!$chosenSalle || $seance->code_salle == $chosenSalle)
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
    $chosenSalle = $request->input('chosenSalle');


    $seances = Seance::with(['prof', 'matiere', 'group'])->get();

    $filteredSeances = $this->filterSeancesByWeekAndSalle($seances, $chosenWeek, $chosenSalle);



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

        // $salle = Salle::find($chosenSalle);
        // $ecole = $salle->seance->group->niveauxscolaire->filiere->departement->ecole;
        $ecoles = []; // An array to store ecole instances

        $salle = Salle::find($chosenSalle);

        if ($salle) {
        foreach ($salle->seance as $seance) {
            $group = $seance->group;
            $niveauxScolaire = $group->niveauxscolaire;
            $filiere = $niveauxScolaire->filiere;
            $departement = $filiere->departement;
            $ecole = $departement->ecole;

            // Store each $ecole in an array if necessary
            $ecoles[] = $ecole;
        }
    }
        // Now you have an array of ecole instances

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
            ->loadView('emploi-du-temps.pdfsalle', compact('ecole','salle','chosenSalle', 'filteredSeances', 'chosenWeek', 'timeIntervals', 'daysOfWeek'))
            ->setPaper('a4', 'landscape') // Set the page size to A4 and landscape orientation
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

            return $pdf->stream('salle.pdf');


}





}



         // public function salle(Request $request)
    // {
    //     // Get all salles
    //     $salles = Salle::all();

    //     // Get the selected salle from the request
    //     $selectedSalleId = $request->input('salle');
    //     $selectedSalle = Salle::find($selectedSalleId);

    //     // Get all seances
    //     $seances = Seance::with(['prof', 'matiere', 'salle', 'group'])->get();

    //     // Generate days of the week
    //     $daysOfWeek = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];

    //     $timeIntervals = [
    //         '08:00:00 - 09:00:00',
    //         '09:00:00 - 10:00:00',
    //         '10:00:00 - 11:00:00',
    //         '11:00:00 - 12:00:00',
    //         '12:00:00 - 13:00:00',
    //         '13:00:00 - 14:00:00',
    //         '14:00:00 - 15:00:00',
    //         '15:00:00 - 16:00:00',
    //         '16:00:00 - 17:00:00',
    //         '17:00:00 - 18:00:00',
    //         '18:00:00 - 19:00:00'
    //     ];

    //     // Filter seances based on the selected week and salle
    //     $chosenWeek = $request->get('chosen_week', 1);
    //     $filteredSeances = $this->filterSeancesByWeek($seances, $chosenWeek, $selectedSalle);

    //     return view('emploi-du-temps.salle', compact('salles', 'selectedSalle', 'daysOfWeek', 'timeIntervals', 'filteredSeances', 'chosenWeek'));
    // }
    // private function filterSeancesByWeek($seances, $weekNumber, $selectedSalle)
    // {
    //     $filteredSeances = [];

    //     foreach ($seances as $seance) {
    //         $dayOfWeek = (Carbon::parse($seance->date)->dayOfWeek + 6) % 7;

    //         // Convert the date attribute to a Carbon instance
    //         $seanceDate = Carbon::parse($seance->date);

    //         $startOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->startOfWeek();
    //         $endOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->endOfWeek();

    //         // Calculate the interval index based on the seance's start time
    //      $intervalIndex = $this->getIntervalIndex($seance->heure_debut);

    //         // Check if the seance's date is within the selected week and matches the chosen salle
    //    if (
    //     $seanceDate->isBetween($startOfWeek, $endOfWeek) &&
    //     (!$selectedSalle || $seance->salle->id == $selectedSalle->id)
    // ) {
    //     $filteredSeances[$dayOfWeek][$intervalIndex][] = $seance;
    // }
    //     }

    //     return $filteredSeances;
    // }




    // private function getIntervalIndex($time)
    // {
    //     $intervalIndexMap = [
    //         '08:00:00' => 0,
    //         '09:00:00' => 1,
    //         '10:00:00' => 2,
    //         '11:00:00' => 3,
    //         '12:00:00' => 4,
    //         '13:00:00' => 5,
    //         '14:00:00' => 6,
    //         '15:00:00' => 7,
    //         '16:00:00' => 8,
    //         '17:00:00' => 9,
    //         '18:00:00' => 10,
    //         '18:30:00' => 11,
    //     ];
    //     return isset($intervalIndexMap[$time]) ? $intervalIndexMap[$time] : null;
    // }
