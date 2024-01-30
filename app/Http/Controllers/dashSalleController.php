<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;
use App\Models\Pavilion;

class dashSalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salles = Salle::all();
        return view('salles-dash.index', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $pavilions = Pavilion::all(); // Fetch all pavilions to populate the dropdown
    return view('salles-dash.create', compact('pavilions'));
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
            'status' => 'required|in:salle,atelier,salle informatique',
            'pavilion' => 'required|exists:pavilions,id',
            'description' => 'nullable',
        ]);

        $salle = new Salle;
        $salle->label = $request->input('label');
        $salle->status = $request->input('status');
        $salle->code_pavilion = $request->input('pavilion');
        $salle->description = $request->input('description');
        $salle->save();

        return redirect()->route('dash-salle.index')->with('success', 'Salle ajoutée avec succès.')
        ->with('info', 'Vous pouvez maintenant ajouter des ordinateurs à cette salle.')
        ->with('salle', $salle);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salle = Salle::findOrFail($id);
        return view('salles-dash.show', compact('salle'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the salle to be edited by its ID
        $salle = Salle::findOrFail($id);

        // Retrieve the list of pavilions to populate the dropdown
        $pavilions = Pavilion::all();

        return view('salles-dash.edit', compact('salle', 'pavilions'));
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
            'label' => 'required',
            'status' => 'required|in:salle,atelier,salle informatique',
            'pavilion' => 'required|exists:pavilions,id',
            'description' => 'nullable',
        ]);

        // Find the salle to be updated by its ID
        $salle = Salle::findOrFail($id);

        // Update the salle's attributes
        $salle->label = $request->input('label');
        $salle->status = $request->input('status');
        $salle->code_pavilion = $request->input('pavilion');
        $salle->description = $request->input('description');
        $salle->save();

        return redirect()->route('dash-salle.index')->with('success', 'Salle mise à jour avec succès.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();
        return redirect()->route('dash-salle.index')->with('success', 'Salle supprimée avec succès');
    }
}
