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
use Illuminate\Http\Request;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seances = Seance::all();
        // $seances = Seance::paginate(4);


        // $seances=Seance::select('*')->orderBy("id","ASC")->get();


        // return response()->json($seances);

        // return view('seance.index', ['seances'=>$seances]);
        return view('seance.index', ['seances'=>$seances]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all(); // Fetch the groups from the database
        $profs =Prof::all();
        $matieres =Matiere::all();
        $salles =Salle::all();
        $niveauxscolaires=Niveauxscolaire::all();
        $filieres=Filiere::all();



        return view('seance.create', compact('groups','profs','matieres','salles','niveauxscolaires','filieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Validate the form data
        $validatedData = $request->validate([
            'group' => 'required',
            'matiere' => 'required',
            'prof' => 'required',
            'salle' => 'required',
            'date' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        $seance = new Seance();
        $seance->code_group = $validatedData['group'];
        $seance->code_matiere = $validatedData['matiere']; // Set the foreign key value
        $seance->code_prof = $validatedData['prof']; // Set the foreign key value
        $seance->code_salle = $validatedData['salle']; // Set the foreign key value
        $seance->date = $validatedData['date'];
        $seance->heure_debut = $validatedData['heure_debut'];
        $seance->heure_fin = $validatedData['heure_fin'];

        // Save the seance
        // $seance->save();

        // Save the seance
        if ($seance->save()) {
            // Successful creation
            return redirect()->route('crud.create')->with('success', 'Seance created successfully!');
        } else {
            // Error in saving
            return redirect()->route('crud.create')->with('error', 'Failed to create seance. Please try again.');
        }
        // // Create a new Seance instance with the validated data
        // $seance = new Seance();
        // $seance->group->nom_group = $validatedData['group'];
        // $seance->matiere->nom_matiere = $validatedData['matiere'];
        // $seance->prof->firstName = $validatedData['prof'];
        // $seance->salle->numero_salle = $validatedData['salle'];
        // $seance->date = $validatedData['date'];
        // $seance->heure_debut = $validatedData['heure_debut'];
        // $seance->heure_fin = $validatedData['heure_fin'];

        // // Save the seance
        // $seance->save();

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seance $seance)
    {
        // Retrieve the seance and pass it to the view
        // return view('crud.show', compact('seance'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seance = Seance::find($id);
        $groups = Group::all();
        $matieres = Matiere::all();
        $profs = Prof::all();
        $salles = Salle::all();

        return view('seance.edit', compact('seance', 'groups', 'matieres', 'profs', 'salles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
            // Validate the form data
        $validatedData = $request->validate([
            'group' => 'required',
            // 'matiere' => 'required',
            // 'prof' => 'required',
            // 'salle' => 'required',
            // 'date' => 'required',
            // 'heure_debut' => 'required',
            // 'heure_fin' => 'required',
        ]);

        // // Update the seance with the validated data
        // $seance->group->nom_group = $validatedData['group'];
        // $seance->matiere->nom_matiere = $validatedData['matiere'];
        // $seance->prof->firstName = $validatedData['prof'];
        // $seance->salle->numero_salle = $validatedData['salle'];
        // $seance->date = $validatedData['date'];
        // $seance->heure_debut = $validatedData['heure_debut'];
        // $seance->heure_fin = $validatedData['heure_fin'];

        // // Save the updated seance
        // $seance->save();

        $seance = Seance::find($id);
        $seance->code_group = $validatedData['group'];
        // $seance -> code_group = $request -> input('group');
        // $seance->code_matiere = $validatedData['matiere']; // Set the foreign key value
        // $seance->code_prof = $validatedData['prof']; // Set the foreign key value
        // $seance->code_salle = $validatedData['salle']; // Set the foreign key value
        // $seance->date = $validatedData['date'];
        // $seance->heure_debut = $validatedData['heure_debut'];
        // $seance->heure_fin = $validatedData['heure_fin'];

        // Save the seance
        $seance->save();
        echo "<script>console.log(' hi ',$seance->code_group)</script>";
        // Redirect or do something else after successful update
        return redirect()->route('crud.index')->with('success', 'Seance updated successfully.');

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

        return redirect()->route('crud.index')->with('success', 'Séance supprimée avec succès');
    }

    public function attendance($id)
   {
        $seance = Seance::find($id);
        // $attendance= Attendance ::all();
        // Add your logic to fetch attendance records for the seance
            $attendance = Attendance::where('code_seance', $id)->get();
        return view('seance.attendance', compact('attendance'));
}


}
