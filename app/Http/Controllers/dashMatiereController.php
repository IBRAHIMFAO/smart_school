<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Filiere;
use App\Models\Departement;
use App\Models\Niveauxscolaire;

class dashMatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // Retrieve all matieres with their related filieres
        $matieres = Matiere::with('niveauxscolaire')->get();

        return view('matieres-dash.index', compact('matieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filieres = Filiere::all(); // Get all filieres to populate a dropdown
        $niveauxscolaires = Niveauxscolaire ::all(); // Get all departements to populate a dropdown

        return view('matieres-dash.create', compact('niveauxscolaires', 'filieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         try {
             $request->validate([
                 'label' => 'required',
                 'niveauxscolaire' => 'required|exists:niveauxscolaires,id',
                 'description' => 'nullable',
             ]);

             $matiere = new Matiere;
             $matiere->label = $request->input('label');
             $matiere->code_niveauxscolaire = $request->input('niveauxscolaire');
             $matiere->description = $request->input('description');
             $matiere->save();

             return redirect()->route('dash-matiere.index')->with('success', 'Matière ajoutée avec succès.');
         } catch (\Exception $e) {
             return redirect()->route('dash-matiere.create')->with('error', 'Une erreur s\'est produite lors de l\'ajout de la matière.')
                 ->with('error_details', $e->getMessage())
                 ->withInput();
         }
     }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function show($id)
     {
         $matiere = Matiere::with(['niveauxscolaire.filiere.departement'])->findOrFail($id);
         return view('matieres-dash.show', compact('matiere'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matiere = Matiere::findOrFail($id);
        $niveauxscolaires = Niveauxscolaire::all();

        return view('matieres-dash.edit', compact('matiere', 'niveauxscolaires'));
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
         try {
             $request->validate([
                 'label' => 'required',
                 'niveauxscolaire' => 'required|exists:niveauxscolaires,id',
                 'description' => 'nullable',
             ]);

             $matiere = Matiere::findOrFail($id);
             $matiere->label = $request->input('label');
             $matiere->code_niveauxscolaire = $request->input('niveauxscolaire');
             $matiere->description = $request->input('description');
             $matiere->save();

             return redirect()->route('dash-matiere.index')->with('success', 'Matière mise à jour avec succès.');
         } catch (\Exception $e) {
             return redirect()->route('dash-matiere.edit', $id)->with('error', 'Une erreur s\'est produite lors de la modification de la matière. Veuillez réessayer.')
                 ->with('error_details', $e->getMessage())
                 ->withInput();
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
        $matiere = Matiere::findOrFail($id);
        $matiere->delete();
        return redirect()->route('dash-matiere.index')->with('success', 'Matière supprimée avec succès');
    }
}
