<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seance;
use App\Models\Group;
use Carbon\Carbon;
use App\Models\AnneeScolaire;

use PDF;


class EmploiDuTempsController extends Controller
{


// EmploiDuTempsController.php

public function index(Request $request)
{
        // Récupérer tous les groupes
        $groupes = Group::all();
        $anneeScolaires=Anneescolaire::all();


    // Get all seances
    $seances = Seance::with(['prof', 'matiere', 'salle','group'])->get();

    // Generate days of the week
    $daysOfWeek = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi','demanche'];

    // Generate time intervals
    // $timeIntervals = [
    //     '08:00:00 - 10:00:00',
    //     '10:00:00 - 12:00:00',
    //     '12:00:00 - 14:00:00',
    //     '14:00:00 - 16:00:00',
    //     '16:00:00 - 18:00:00'

    // ];
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
    // $filteredSeances = $this->filterSeancesByWeek($seances, $chosenWeek);

     // Get the chosen week from the request or set a default value
     $chosenWeek = $request->input('week', 1);



     // Récupérer le groupe sélectionné depuis la requête
    $chosenGroup = $request->input('group');

    // Filter seances based on the chosen week
    $filteredSeances = $this->filterSeancesByWeek($seances, $chosenWeek, $chosenGroup);




    // Filtrer les séances en fonction du groupe sélectionné
    // if ($chosenGroup) {
    //     $seances = $seances->where('code_group', $chosenGroup);
    // }



return view('emploi-du-temps.group', compact( 'anneeScolaires','groupes','chosenGroup','daysOfWeek', 'timeIntervals', 'filteredSeances', 'chosenWeek')
    );}

// private function filterSeancesByWeek($seances, $weekNumber , $chosenGroup)
// {
//     $filteredSeances = [];

//     foreach ($seances as $seance) {
//         // $dayOfWeek = $seance->dayOfWeek;
//         // $dayOfWeek = Carbon::parse($seance->date)->dayOfWeek; // Corrected line
//         $dayOfWeek = (Carbon::parse($seance->date)->dayOfWeek + 6) % 7;



//         // Convert the date attribute to a Carbon instance
//         $seanceDate = Carbon::parse($seance->date);

//         $startOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->startOfWeek();
//         $endOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->endOfWeek();

//         // if ($seanceDate->isBetween($startOfWeek, $endOfWeek)) {
//         //     $filteredSeances[$dayOfWeek][$seance->heure_debut . ' - ' . $seance->heure_fin][] = $seance;
//         // }
//         // Check if the seance's date is within the selected week and matches the chosen group
//         if (
//             $seanceDate->isBetween($startOfWeek, $endOfWeek) &&
//             (!$chosenGroup || $seance->code_group == $chosenGroup)
//         ) {
//             $filteredSeances[$dayOfWeek][$seance->heure_debut . ' - ' . $seance->heure_fin][] = $seance;
//         }
//     }


//     return $filteredSeances;
// }


// ... (other code remains the same)



// private function filterSeancesByWeek($seances, $weekNumber, $chosenGroup)
// {
//     $filteredSeances = [];

//     foreach ($seances as $seance) {
//         $dayOfWeek = (Carbon::parse($seance->date)->dayOfWeek + 6) % 7;

//         // Convert the date attribute to a Carbon instance
//         $seanceDate = Carbon::parse($seance->date);

//         $startOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->startOfWeek();
//         $endOfWeek = Carbon::now()->setISODate(now()->year, $weekNumber)->endOfWeek();

//         // Calculate the interval index based on the seance's start time
//         $intervalIndexes = $this->getIntervalIndexes($seance->heure_debut, $seance->heure_fin);

//         // Check if the seance's date is within the selected week and matches the chosen group
//         if (
//             $seanceDate->isBetween($startOfWeek, $endOfWeek) &&
//             (!$chosenGroup || $seance->code_group == $chosenGroup)
//         ) {
//             foreach ($intervalIndexes as $intervalIndex) {
//                 $filteredSeances[$dayOfWeek][$intervalIndex][] = $seance;
//             }
//         }
//     }

//     return $filteredSeances;
// }

// private function getIntervalIndexes($startTime, $endTime)
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

//     $startIndex = $intervalIndexMap[$startTime];
//     $endIndex = $intervalIndexMap[$endTime];

//     $intervalIndexes = range($startIndex, $endIndex);

//     return $intervalIndexes;
// }




private function filterSeancesByWeek($seances, $weekNumber, $chosenGroup)
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

        // Check if the seance's date is within the selected week and matches the chosen group
        if (
            $seanceDate->isBetween($startOfWeek, $endOfWeek) &&
            (!$chosenGroup || $seance->code_group == $chosenGroup)
        ) {
            $filteredSeances[$dayOfWeek][$intervalIndex][] = $seance;
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



    // var_dump($intervalIndexMap);
    return isset($intervalIndexMap[$time]) ? $intervalIndexMap[$time] : null;

}



public function downloadPdf(Request $request)
{

    // dd($request->all());


    $chosenWeek = $request->input('chosenWeek');
    // $seanceColor = $request->input('seanceColor');
    $chosenGroup = $request->input('chosenGroup');


    $seances = Seance::with(['prof', 'matiere', 'group'])->get();


    $filteredSeances = $this->filterSeancesByWeek($seances, $chosenWeek, $chosenGroup);



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

        $group = Group::find($chosenGroup);
        $ecoles = []; // An array to store ecole instances

        // $ecole=$prof->departements->ecole;
        $ecole = $group->niveauxscolaire->filiere->departement->ecole;

        // var_dump($ecole["logo"]);

    //     if ($group) {
    //     foreach ($prof->seances as $seance) {
    //         $group = $seance->group;
    //         $niveauxScolaire = $group->niveauxscolaire;
    //         $filiere = $niveauxScolaire->filiere;
    //         $departement = $filiere->departement;
    //         $ecole = $departement->ecole;

    //         // Store each $ecole in an array if necessary
    //         $ecoles[] = $ecole;
    //     }
    // }
    //     Now you have an array of ecole instances

            // $path = public_path('storage/' . $ecole->logo);
           
            // $path = public_path('storage/' . $ecole->logo);
            // $path = public_path('storage/images/logos/LogoAlbita2.png' );

            $pic = ''; // Initialize $pic before the if statement

            $path = public_path('storage/'.$ecole["logo"] );


            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);

                $data = file_get_contents($path);

                $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }

            // else {
            //     // Définir une valeur par défaut si le fichier image n'existe pas
            //     $pic = ''; // ou une autre valeur par défaut selon vos besoins
            // }


            // $path_mdlnational = url('storage/images/logos/mdlnationale.png');

            // $path_mdlnational = public_path('storage/logos/LogoAlbita2.png' );
            
            $path_mdlnational = public_path('storage/images/logos/mdlnationale.png');

            if (file_exists($path_mdlnational)) {
                $type_mdlnational = pathinfo($path_mdlnational, PATHINFO_EXTENSION);
                $data_mdlnational = file_get_contents($path_mdlnational);
                $pic_mdlnational = 'data:image/' . $type_mdlnational . ';base64,' . base64_encode($data_mdlnational);
            } 
            else {
                $pic_mdlnational = ''; // Set it to an empty string if the file does not exist
                
            }
            

            // Modify your code to set the page size and orientation
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            
            ->loadView('emploi-du-temps.pdf-group', compact('ecole','group','pic_mdlnational','pic','chosenGroup', 'filteredSeances', 'chosenWeek', 'timeIntervals', 'daysOfWeek'))
            ->setPaper('a4', 'landscape') // Set the page size to A4 and landscape orientation
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

            return $pdf->stream('group.pdf');
            // return $pdf->download('emploi-du-temps.pdf');


}


}

