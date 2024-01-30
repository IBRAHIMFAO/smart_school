<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filiere;
use App\Models\Departement;

class dashFiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filieres = Filiere::all();
        return view('filieres-dash.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = Departement::all();
        return view('filieres-dash.create', compact('departements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   // Stocke une nouvelle filière dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'code_departement' => 'required|exists:departements,id',
            'nom_filiere' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Filiere::create([
            'code_departement' => $request->code_departement,
            'nom_filiere' => $request->nom_filiere,
            'description' => $request->description,
        ]);

        return redirect()->route('dash-filiere.index')->with('success', 'Filière créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filiere = Filiere::findOrFail($id);

        return view('filieres-dash.show', compact('filiere'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   // Affiche le formulaire d'édition d'une filière
   public function edit($id)
   {
       $filiere = Filiere::findOrFail($id);
       $departements = Departement::all(); // Vous pouvez ajuster la requête pour récupérer les départements selon vos besoins.

       return view('filieres-dash.edit', compact('filiere', 'departements'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // Met à jour une filière dans la base de données
     public function update(Request $request, $id)
     {
         $request->validate([
             'code_departement' => 'required|exists:departements,id',
             'nom_filiere' => 'required|string|max:255',
             'description' => 'nullable|string',
         ]);

         $filiere = Filiere::findOrFail($id);
         $filiere->code_departement = $request->code_departement;
         $filiere->nom_filiere = $request->nom_filiere;
         $filiere->description = $request->description;
         $filiere->save();

         return redirect()->route('dash-filiere.index')->with('success', 'Filière mise à jour avec succès.');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Supprime une filière de la base de données
    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();

        return redirect()->route('dash-filiere.index')->with('success', 'Filière supprimée avec succès.');
    }
}
