<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Seance;
use App\Models\Salle;
use App\Models\Prof;
use App\Models\Group;
use App\Models\Niveauxscolaire;
use App\Models\AnneeScolaire;
use App\Models\Ecole;
use App\Models\Departement;
use App\Models\Pavilion;



use Illuminate\Http\Request;

class dashSeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seances = Seance::paginate(6);

        return view('seances-dash.index', ['seances'=>$seances]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetch the required data for your dropdown fields (e.g., anneeScolaires, ecoles, departements, etc.)
        $anneeScolaires = AnneeScolaire::all(); // Replace AnneeScolaire with your actual model name
        $ecoles = Ecole::all(); // Replace Ecole with your actual model name
        $departements = Departement::all(); // Replace Departement with your actual model name
        $filieres = Filiere::all(); // Replace Filiere with your actual model name
        $niveauxScolaires = NiveauxScolaire::all(); // Replace NiveauxScolaire with your actual model name
        $groupes = Group::all(); // Replace Groupe with your actual model name
        $salles = Salle::all(); // Replace Salle with your actual model name
        $matieres = Matiere::all(); // Replace Matiere with your actual model name
        $profs = Prof::all(); // Replace Prof with your actual model name
        $pavilions = Pavilion::all(); // Replace Pavilion with your actual model name


        return view('seances-dash.create', compact('anneeScolaires', 'ecoles', 'departements', 'filieres', 'niveauxScolaires', 'groupes', 'salles', 'matieres', 'profs', 'pavilions'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

//     public function store(Request $request)
//         {
//             // Validate the form data
//             $validatedData = $request->validate([
//                 'annee_scolaire' => 'required', // Make sure the field is required
//                 'group' => 'required',
//                 'matiere' => 'required',
//                 'prof' => 'required',
//                 'salle' => 'required',
//                 'date' => 'required',
//                 'heure_debut' => 'required',
//                 'heure_fin' => 'required',
//                 'periodicite' => 'required|in:Annee,Mois,Semaine,Jour', // Validate the periodicite field

//             ]);

//             $seance = new Seance();
//             $seance->code_annee_scolaire = $validatedData['annee_scolaire']; // Assign the academic year
//             $seance->code_group = $validatedData['group'];
//             $seance->code_matiere = $validatedData['matiere'];
//             $seance->code_prof = $validatedData['prof'];
//             $seance->code_salle = $validatedData['salle'];
//             $seance->date = $validatedData['date'];
//             $seance->heure_debut = $validatedData['heure_debut'];
//             $seance->heure_fin = $validatedData['heure_fin'];
//             $seance->periodicite = $validatedData['periodicite']; // Assign the periodicite value


//                         // Save the first seance
//                 if (!$seance->save()) {
//                     // Error in saving
//                     return redirect()->route('dash-seance.create')->with('error', 'Failed to create seance. Please try again.');
//                 }

//                 // Handle repetition based on the selected option
                // switch ($validatedData['periodicite']) {
                //     case 'Jour':
                //         // Repeating every day until the end of the academic year
                //         $endDate = AnneeScolaire::find($validatedData['annee_scolaire'])->end_date;

                //         $currentDate = $validatedData['date'];
                //         while (strtotime($currentDate) < strtotime($endDate)) {
                //             $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));

                //             // Create a new seance with the same details as the first one, but with the next date
                //             $newSeance = $seance->replicate();
                //             $newSeance->date = $nextDate;
                //             $newSeance->save();

                //             $currentDate = $nextDate;
                //         }
                //         break;

                //     case 'Semaine':
                //         // Repeating every week until the end of the academic year
                //         $endDate = AnneeScolaire::find($validatedData['annee_scolaire'])->end_date;

                //         $currentDate = $validatedData['date'];
                //         while (strtotime($currentDate) < strtotime($endDate)) {
                //             $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 week'));

                //             // Create a new seance with the same details as the first one, but with the next date
                //             $newSeance = $seance->replicate();
                //             $newSeance->date = $nextDate;
                //             $newSeance->save();

                //             $currentDate = $nextDate;
                //         }
                //         break;

                //     case 'Mois':
                //         // Repeating every month until the end of the academic year
                //         $endDate = AnneeScolaire::find($validatedData['annee_scolaire'])->end_date;

                //         $currentDate = $validatedData['date'];
                //         while (strtotime($currentDate) < strtotime($endDate)) {
                //             $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 month'));

                //             // Create a new seance with the same details as the first one, but with the next date
                //             $newSeance = $seance->replicate();
                //             $newSeance->date = $nextDate;
                //             $newSeance->save();

                //             $currentDate = $nextDate;
                //         }
                //         break;

                //     case 'Annee':
                //         // Repeating every year until the end of the academic year
                //         $endDate = AnneeScolaire::find($validatedData['annee_scolaire'])->end_date;

                //         $currentDate = $validatedData['date'];
                //         while (strtotime($currentDate) < strtotime($endDate)) {
                //             $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 year'));

                //             // Create a new seance with the same details as the first one, but with the next date
                //             $newSeance = $seance->replicate();
                //             $newSeance->date = $nextDate;
                //             $newSeance->save();

                //             $currentDate = $nextDate;
                //         }
                //         break;

                //     default:
                //         // Do nothing if no repetition option is selected
                //         break;
                // }

//                 // Successful creation
//                 return redirect()->route('dash-seance.create')->with('success', 'Seance(s) created successfully!');


//         }


        // ###########################################################################################



        public function store(Request $request)
        {
            // Étape 1: Valider les données du formulaire
            $validatedData = $request->validate([
                'annee_scolaire' => 'required',
                'groupe' => 'required',
                'matiere' => 'required',
                'prof' => 'required',
                'salle' => 'required',
                'date' => 'required',
                'heure_debut' => 'required',
                'heure_fin' => 'required',
                'periodicite' => 'required|in:Année,Mois,Semaine,Jour',
                'type' => 'required', // Ajoutez la validation pour le champ Type de Séance
                'status' => 'required', // Ajoutez la validation pour le champ Statut de la Séance
                'notes' => 'nullable', // Rendez le champ Notes facultatif
            ]);

            // Étape 2: Créer une nouvelle séance
            $seance = new Seance();
            $seance->code_group = $validatedData['groupe'];
            $seance->code_matiere = $validatedData['matiere'];
            $seance->code_prof = $validatedData['prof'];
            $seance->code_salle = $validatedData['salle'];
            $seance->date = $validatedData['date'];
            $seance->heure_debut = $validatedData['heure_debut'];
            $seance->heure_fin = $validatedData['heure_fin'];
            $seance->periodicite = $validatedData['periodicite'];
            $seance->type = $validatedData['type']; // Affectez la valeur du champ Type de Séance
            $seance->status = $validatedData['status']; // Affectez la valeur du champ Statut de la Séance
            $seance->notes = $validatedData['notes']; // Affectez la valeur du champ Notes

            // Étape 3: Récupérer l'année scolaire sélectionnée par son ID
            $anneeScolaire = AnneeScolaire::find($validatedData['annee_scolaire']);

            // Étape 4: Assurez-vous que l'année scolaire a été trouvée
            if ($anneeScolaire) {
                // Étape 5: Créez une chaîne de caractères contenant les dates de début et de fin de l'année scolaire
                $anneeScolaireValue = $anneeScolaire->start_date . ' / ' . $anneeScolaire->end_date;

                // Étape 6: Affectez cette chaîne de caractères au champ 'annee_scolaire' de la séance
                $seance->annee_scolaire = $anneeScolaireValue;

                // Étape 7: Appelez la fonction pour créer les séances répétées
                $this->createRepeatingSeances($seance, $validatedData['periodicite'], $anneeScolaire->start_date, $anneeScolaire->end_date);
            } else {
                // Étape 8: Gérez l'erreur si l'année scolaire n'est pas trouvée
                return redirect()->route('dash-seance.create')->with('error', 'Année scolaire non trouvée.');
            }

            // Étape 9: Enregistrez la première séance
            if (!$seance->save()) {
                // Étape 10: Gérez l'erreur si l'enregistrement échoue
                return redirect()->route('dash-seance.create')->with('error', 'Échec de la création de la séance. Veuillez réessayer.');
            }

            // Étape 11: Redirigez l'utilisateur vers la liste des séances avec un message de succès
            return redirect()->route('dash-seance.index')->with('success', 'Séance(s) créée(s) avec succès!');
        }




        private function createRepeatingSeances($seance, $periodicite, $start_date, $end_date)
        {
            $currentDate = $seance->date;

            while (strtotime($currentDate) <= strtotime($end_date)) {
                switch ($periodicite) {
                    case 'Jour':
                        $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
                        break;
                    case 'Semaine':
                        $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 week'));
                        break;
                    case 'Mois':
                        $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 month'));
                        break;
                    case 'Année':
                        $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 year'));
                        break;
                    default:
                        return;
                }

                if (strtotime($nextDate) > strtotime($end_date)) {
                    break; // S'assurer de ne pas dépasser la fin de l'année
                }

                // Créer une nouvelle séance avec les mêmes détails que la première, mais avec la date suivante
                $newSeance = $seance->replicate();
                $newSeance->date = $nextDate;
                $newSeance->save();

                $currentDate = $nextDate;
            }
        }

        // ######################################################################################################






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


        public function show($id)
    {
        $seance = Seance::findOrFail($id);

        return view('seances-dash.show', compact('seance'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        // Retrieve the Seance you want to edit
        $seance = Seance::find($id);

        // Retrieve any necessary data, for example, related records like Ecoles, Departements, etc.
        $ecoles = Ecole::all();
        $departements = Departement::all();
        $filieres= Filiere::all();
        $niveauxScolaires = Niveauxscolaire::all();

        // Retrieve other data needed for the form, such as academic years, groups, matieres, profs, and salles
        $anneeScolaires = AnneeScolaire::all();
        $groupes = Group::all();
        $matieres = Matiere::all();
        $profs = Prof::all();
        $salles = Salle::all();
        $pavillons = Pavilion::all();

        // Check if the Seance was found
        if (!$seance) {
            return redirect()->route('dash-seance.index')->with('error', 'Seance not found.');
        }

        return view('seances-dash.edit', compact('seance', 'anneeScolaires', 'groupes', 'matieres', 'profs', 'salles','pavillons' , 'ecoles', 'departements', 'filieres', 'niveauxScolaires'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'annee_scolaire' => 'nullable',
            'groupe' => 'required',
            'matiere' => 'required',
            'prof' => 'required',
            'salle' => 'required',
            'date' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            // 'periodicite' => 'required|in:Année,Mois,Semaine,Jour',
            // 'periodicite' => 'required',
            'type' => 'required', // Add validation for Type de Séance
            'status' => 'required', // Add validation for Statut de la Séance
            'notes' => 'nullable', // Make Notes field optional
        ]);

        // Find the Seance you want to update by its ID
        $seance = Seance::findOrFail($id);

        if (!$seance) {
            return redirect()->route('dash-seance.edit', $id)->with('error', 'Séance not found.');
        }

        // Update the Seance with the validated data
        $seance->code_group = $validatedData['groupe'];
        $seance->code_matiere = $validatedData['matiere'];
        $seance->code_prof = $validatedData['prof'];
        $seance->code_salle = $validatedData['salle'];
        $seance->date = $validatedData['date'];
        $seance->heure_debut = $validatedData['heure_debut'];
        $seance->heure_fin = $validatedData['heure_fin'];
        $seance->periodicite = $validatedData['periodicite'] = $seance->periodicite;
        $seance->type = $validatedData['type']; // Update Type de Séance
        $seance->status = $validatedData['status']; // Update Statut de la Séance
        $seance->notes = $validatedData['notes']; // Update Notes

        // Récupérez l'année scolaire sélectionnée par son ID
        $anneeScolaire = AnneeScolaire::find($validatedData['annee_scolaire']);

        // Assurez-vous que l'année scolaire a été trouvée
        if ($anneeScolaire) {
            // Créez une chaîne de caractères contenant les dates de début et de fin
            $anneeScolaireValue = $anneeScolaire->start_date . ' - ' . $anneeScolaire->end_date;

            // Affectez cette chaîne de caractères au champ 'annee_scolaire' de la séance
            $seance->annee_scolaire = $anneeScolaireValue;

            $seance->save();

            return redirect()->route('dash-seance.index', $seance->id)->with('success', 'Seance updated successfully!');

        }else{

            $seance->annee_scolaire = $seance->annee_scolaire  ;
            $seance->save();
            return redirect()->route('dash-seance.show', $seance->id)->with('success', 'Seance updated successfully!');
        }



        // Save the updated Seance
        if ($seance->save()) {
            return redirect()->route('dash-seance.index', $seance->id)->with('success', 'Seance updated successfully!');
        } else {
            return redirect()->route('dash-seance.edit', $seance->id)->with('error', 'Failed to update seance. Please try again.')
                ->withInput()
                ->withErrors($validatedData);
        }
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seance = Seance::find($id);
        $seance->delete();

        return redirect()->route('dash-seance.index')->with('success', 'Séance supprimée avec succès');
    }

    public function attendance($id)
    {
         $seance = Seance::find($id);
         // $attendance= Attendance ::all();
         // Add your logic to fetch attendance records for the seance
             $attendance = Attendance::where('code_seance', $id)->get();
         return view('seances-dash.attendance', compact('attendance'));
 }



 //  ############################ filtre  ##################################################

    public function getSalles($pavillon)
    {
        $salles = Salle::where('code_pavilion', $pavillon)->pluck('label', 'id')->toArray();

        return response()->json($salles);
    }



        public function getEcoles(Request $request)
    {
        $ecoles = Ecole::where('code_annee_scolaire', $request->input('annee_scolaire'))->get();
        return response()->json($ecoles);
    }

    public function getDepartements(Request $request)
    {
        $departements = Departement::where('code_ecole', $request->input('ecole'))->get();
        return response()->json($departements);
    }

    public function getFilieres(Request $request)
    {
        $filieres = Filiere::where('code_departement', $request->input('departement'))->get();
        return response()->json($filieres);
    }

    public function getNiveauxScolaires(Request $request)
    {
        $niveauxScolaires = Niveauxscolaire::where('code_filiere', $request->input('filiere'))->get();
        return response()->json($niveauxScolaires);
    }

    public function getGroups(Request $request)
    {
        $groups = Group::where('code_niveauxscolaire', $request->input('niveaux_scolaire'))->get();
        return response()->json($groups);
    }








}


