<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\Student;
use App\Models\Ecole;
use App\Models\Departement;
use App\Models\Filiere;
use App\Models\Niveauxscolaire;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\DB;
use App\Exports\GroupExport;
use Maatwebsite\Excel\Facades\Excel;




use Illuminate\Http\Request;

class dashGroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $groups = Group::paginate(4) ;
    //     return view('groupes-dash.index', compact('groups'));
    // }




    public function index(Request $request)
    {
        $anneeScolaires = AnneeScolaire::all();
        $ecoles = Ecole::all();
        $departements = Departement::all();
        $filieres = Filiere::all();

        $selectedAnneeScolaire = $request->input('annee_scolaire');
        $selectedEcole = $request->input('ecole');
        $selectedDepartement = $request->input('departement');
        $selectedFiliere = $request->input('filiere');

        $query = Group::query();

        
        
        if ($selectedAnneeScolaire) {
            $query->whereHas('niveauxscolaire.filiere.departement.ecole.anneeScolaire', function ($query) use ($selectedAnneeScolaire) {
                $query->where('id', $selectedAnneeScolaire);
            });
        }


        if ($selectedEcole) {
            $query->whereHas('niveauxscolaire.filiere.departement.ecole', function ($query) use ($selectedEcole) {
                $query->where('id', $selectedEcole);
            });
        }

        if ($selectedDepartement) {
            $query->whereHas('niveauxscolaire.filiere.departement', function ($query) use ($selectedDepartement) {
                $query->where('id', $selectedDepartement);
            });
        }

        if ($selectedFiliere) {
            $query->whereHas('niveauxscolaire.filiere', function ($query) use ($selectedFiliere) {
                $query->where('id', $selectedFiliere);
            });
        }

        $groups = $query->get();
        $perPage = 10; // You can adjust this to the number of results per page you want

        $groups = $query->paginate($perPage);
        
        // dd($selectedAnneeScolaire);

        return view('groupes-dash.index', compact('groups', 'anneeScolaires', 'ecoles', 'departements', 'filieres','selectedAnneeScolaire', 'selectedEcole', 'selectedDepartement', 'selectedFiliere'));
    }

        
    public function export(Request $request)
    {
        $selectedAnneeScolaire = $request->input('annee_scolaire');
        $selectedEcole = $request->input('ecole');
        $selectedDepartement = $request->input('departement');
        $selectedFiliere = $request->input('filiere');
        
        $query = Group::query();
        
        if ($selectedAnneeScolaire) {
            $query->whereHas('niveauxscolaire.filiere.departement.ecole.anneeScolaire', function ($query) use ($selectedAnneeScolaire) {
                $query->where('id', $selectedAnneeScolaire);
            });
        }


        if ($selectedEcole) {
            $query->whereHas('niveauxscolaire.filiere.departement.ecole', function ($query) use ($selectedEcole) {
                $query->where('id', $selectedEcole);
            });
        }

        if ($selectedDepartement) {
            $query->whereHas('niveauxscolaire.filiere.departement', function ($query) use ($selectedDepartement) {
                $query->where('id', $selectedDepartement);
            });
        }

        if ($selectedFiliere) {
            $query->whereHas('niveauxscolaire.filiere', function ($query) use ($selectedFiliere) {
                $query->where('id', $selectedFiliere);
            });
        }

        // Get all groups based on the applied filters
    $groups = $query->get();

    // Define the header data (as previously shown)
    $headerData = [
        'Année Scolaire:',
        'Nom de l\'école:',
        'Département:',
        'Filière:',
        'Niveau Scolaire' ,
         'Nom du groupe',
    ];
        
    $groupsData = $groups->map(function ($group) {
        // Convert start_date and end_date to Carbon instances
        $start_date = \Carbon\Carbon::parse($group->niveauxscolaire->filiere->departement->ecole->anneeScolaire->start_date);
        $end_date = \Carbon\Carbon::parse($group->niveauxscolaire->filiere->departement->ecole->anneeScolaire->end_date);
    
        return [
            $start_date->format('Y') . ' - ' . $end_date->format('Y'),
            $group->niveauxscolaire->filiere->departement->ecole->nom_ecole,
            $group->niveauxscolaire->filiere->departement->label,
            $group->niveauxscolaire->filiere->nom_filiere,
            $group->niveauxscolaire->label ,
            $group->nom_group
        ];
    });

   

    
    
        
        return Excel::download(new GroupExport($headerData, $groupsData), 'groups.xlsx');
        
    
        }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anneeScolaires = AnneeScolaire::all();
        $ecoles = Ecole::all();
        $departements = Departement::all();
        $filieres = Filiere::all();
        $niveauxScolaires = Niveauxscolaire::all(); // Add this line to fetch niveauxScolaires

        
        return view('groupes-dash.create', compact('anneeScolaires', 'ecoles', 'departements', 'filieres', 'niveauxScolaires'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
{
    $request->validate([
        'nom_group' => 'required|string|max:255',
        'niveau_scolaire' => 'required|exists:niveauxscolaires,id', // Ensure that code_niveauxscolaire exists in the niveauxscolaires table
    ]);

    $group= new Group([
        'nom_group' => $request->input('nom_group'),
        'code_niveauxscolaire' => $request->input('niveau_scolaire'),
    ]);

    // Save the Groupe instance to the database
    $group->save();


    // Redirect to the index page or any other appropriate page
    return redirect()->route('dash-groupe.index')->with('success', 'Groupe créé avec succès.');
}

     
     
     


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $group = Group::find($id);
    //     $students= Student::where('code_group',$id)->get();
    //     // $students = $group->student;
    //     return view('groupes-dash.show', compact('group', 'students'));
    // }
    public function show($id)
{
    $group = Group::findOrFail($id);

    return view('groupes-dash.show', compact('group'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $niveauxScolaires = Niveauxscolaire::all(); // You may need to adjust this based on your data structure.
    
        return view('groupes-dash.edit', compact('group', 'niveauxScolaires'));
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
        $request->validate([
            'nom_group' => 'required|string|max:255',
            'niveau_scolaire_id' => 'required|exists:niveauxscolaires,id',
        ]);
    
        $group = Group::findOrFail($id);
    
        $group->update([
            'nom_group' => $request->input('nom_group'),
            'code_niveauxscolaire' => $request->input('niveau_scolaire_id'),
        ]);
    
        return redirect()->route('dash-groupe.index')->with('success', 'Le groupe a été mis à jour avec succès.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    try {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->route('dash-groupe.index')
            ->with('success', 'Groupe supprimé avec succès.');
    } catch (\Exception $e) {
        return redirect()->route('dash-groupe.index')
            ->with('error', 'Une erreur s\'est produite lors de la suppression du groupe.');
    }
}


// public function getNiveauxScolaires(Request $request)
// {
//     $filiereId = $request->input('filiereId');
    
//     // Fetch niveaux scolaires based on the selected filière
//     $niveauxScolaires = Niveauxscolaire::where('code_filiere', $filiereId)->pluck('label', 'id');

//     return response()->json($niveauxScolaires);
// }


// Other methods...

public function fetchFilieres($departementId)
{
    $filieres = Filiere::where('code_departement', $departementId)->get();
    return response()->json($filieres);
}

public function fetchNiveauxScolaires($filiereId)
{
    $niveauxscolaires = Niveauxscolaire::where('code_filiere', $filiereId)->get();
    return response()->json($niveauxscolaires);
}

public function fetchDepartements()
{
    $departements = Departement::all();
    return response()->json($departements);
}





}
