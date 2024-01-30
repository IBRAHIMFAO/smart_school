<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Ecole;

class dashDepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departements = Departement::all();
        return view('departements-dash.index', compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ecoles = Ecole::all(); // Fetch all ecoles to pass to the view
        return view('departements-dash.create', compact('ecoles'));
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
        'code_ecole' => 'required',
        'label' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    Departement::create([
        'code_ecole' => $request->input('code_ecole'),
        'label' => $request->input('label'),
        'description' => $request->input('description'),
    ]);

    return redirect()->route('dash-departement.index')->with('success', 'Departement created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    $departement = Departement::findOrFail($id);
    return view('departements-dash.show', compact('departement'));
}



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departement = Departement::findOrFail($id);
        $ecoles = Ecole::all(); // Fetch all ecoles for the dropdown
        return view('departements-dash.edit', compact('departement', 'ecoles'));
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
        $departement = Departement::findOrFail($id);

        $request->validate([
            'code_ecole' => ['required', 'exists:ecoles,id'],
            'label' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $departement->update([
            'code_ecole' => $request->input('code_ecole'),
            'label' => $request->input('label'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('dash-departement.index')
                        ->with('success', 'Departement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departement = Departement::findOrFail($id);
        $departement->delete();

        return redirect()->route('dash-departement.index')
                         ->with('success', 'Departement deleted successfully.');
    }
}
