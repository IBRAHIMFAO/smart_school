<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Niveauxscolaire;
use App\Models\Filiere;
use App\Models\Departement;

class dashNiveauxscolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        // Fetch all departments and niveauxscolaires and pass them to the view
        public function index(Request $request)
        {
            $departments = Departement::all(); // Fetch all departments

            // Check if a department is selected in the request
            $selectedDepartment = $request->input('department_id');

            // Fetch niveauxscolaires based on the selected department
            $query = NiveauxScolaire::query();
            if ($selectedDepartment) {
                $query->whereIn('code_filiere', function($query) use ($selectedDepartment) {
                    $query->select('id')
                        ->from('filieres')
                        ->where('code_departement', $selectedDepartment);
                });
            }
            $niveauxscolaires = $query->get();

            return view('niveauxscolaires-dash.index', compact('niveauxscolaires', 'departments', 'selectedDepartment'));
        }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

            public function create()
        {
            $departments = Departement::all();
            $filieres = Filiere::all();
            return view('niveauxscolaires-dash.create', compact('departments', 'filieres'));
        }

        // #######code ajax in create page #########
            public function fetchFilieres($department)
        {
            $filieres = Filiere::where('code_departement', $department)->get();

            return response()->json($filieres);
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
                'label' => 'required',
                'filiere' => 'required|exists:filieres,id',
            ]);

            Niveauxscolaire::create([
                // 'label' => $request->input('label'),
                // 'code_filiere' =>$request->input('code_filiere'),
                'label' => $request->label,
                'code_filiere' =>$request->filiere
            ]);



            return redirect()->route('dash-niveauxscolaire.index')->with('success', 'Niveau Scolaire créé avec succès.');
        }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


        public function show($id)
        {
            $niveauScolaire = Niveauxscolaire::with('filiere.departement')->findOrFail($id);

            return view('niveauxscolaires-dash.show', compact('niveauScolaire'));
        }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {

    //     $niveauScolaire = Niveauxscolaire::findOrFail($id);
    //     $departments = Departement::all(); // Assuming you have a method to get all departments

    //     // Pass the current "Filière" ID to the view
    //     $currentFiliereId = $niveauScolaire->code_filiere;

    //     return view('niveauxscolaires-dash.edit', compact('niveauScolaire', 'departments', 'currentFiliereId'));
    // }

    public function edit($id)
    {
        $niveauScolaire = Niveauxscolaire::findOrFail($id);
        $departments = Departement::all(); // Fetch all departments

        return view('niveauxscolaires-dash.edit', compact('niveauScolaire', 'departments'));
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
        // Validate the incoming data
        $validatedData = $request->validate([
            'label' => 'required|string|max:255',
            'departement' => 'required|exists:departements,id', // Ensure the selected département exists
            'filiere' => 'required|exists:filieres,id', // Ensure the selected filière exists
        ]);

        // Find the NiveauScolaire record to update
        $niveauScolaire = Niveauxscolaire::findOrFail($id);

        // Update the NiveauScolaire record
        $niveauScolaire->label = $validatedData['label'];
        $niveauScolaire->code_filiere = $validatedData['filiere'];
        $niveauScolaire->save();

        // Redirect back to the index page with a success message
        return redirect()->route('dash-niveauxscolaire.index')->with('success', 'Niveau Scolaire modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $niveau = NiveauxScolaire::findOrFail($id);
        $niveau->delete();
        return redirect()->route('dash-niveauxscolaire.index')->with('success', 'Niveau scolaire supprimé avec succès');
    }
}
