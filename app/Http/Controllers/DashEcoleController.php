<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Directeur;
use App\Models\Ecole;
use Illuminate\Http\Request;


class DashEcoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $ecoles = Ecole::with('directeur')->get();

    return view('ecoles-dash.index', compact('ecoles'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directeurs= Directeur ::all();
        return view('ecoles-dash.create',compact('directeurs'));
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
            'nom_ecole' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
            'lien_facebook' => 'nullable|string|max:255',
            'lien_instagram' => 'nullable|string|max:255',
            'map_iframe' => 'nullable|string|max:255',
            'code_directeur' => 'required|integer|exists:directeurs,id', // Make sure this is correct
        ]);



        Ecole::create([
            'nom_ecole' => $request->input('nom_ecole'),
            'adresse' => $request->input('adresse'),
            'logo' => $request->file('logo')->store('images/logos', 'public'), // Assuming logo is an uploaded file
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'lien_facebook' => $request->input('lien_facebook'),
            'lien_instagram' => $request->input('lien_instagram'),
            'map_iframe' => $request->input('map_iframe'),
            'code_directeur' => $request->input('code_directeur'),
        ]);

        return redirect()->route('dash-ecole.index')->with('success', 'Ecole created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ecole = Ecole::with('directeur')->findOrFail($id);

        return view('ecoles-dash.show', compact('ecole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ecole = Ecole::with('directeur')->findOrFail($id);
        $directeurs = Directeur::all(); // Fetch the list of directors
        return view('ecoles-dash.edit', compact('ecole', 'directeurs'));
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
            // $ecole = Ecole::findOrFail($id);
            $ecole = Ecole::with('directeur')->findOrFail($id);

            $request->validate([
                'nom_ecole' => 'required|string|max:255',
                'adresse' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'lien_facebook' => 'nullable|string|max:255',
                'lien_instagram' => 'nullable|string|max:255',
                'map_iframe' => 'nullable|string|max:255',
                'code_directeur' => 'required|exists:directeurs,id', // Assuming this is a foreign key relationship
            ]);

            $data = [
                'nom_ecole' => $request->input('nom_ecole'),
                'adresse' => $request->input('adresse'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'lien_facebook' => $request->input('lien_facebook'),
                'lien_instagram' => $request->input('lien_instagram'),
                'map_iframe' => $request->input('map_iframe'),
                'code_directeur' => $request->input('code_directeur'),
            ];

            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($ecole->logo && Storage::disk('public')->exists($ecole->logo)) {
                    Storage::disk('public')->delete($ecole->logo);
                }

                $data['logo'] = $request->file('logo')->store('images/logos', 'public');
            }

            $ecole->update($data);

            return redirect()->route('dash-ecole.index')->with('success', 'Ecole updated successfully.');
        }


            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy(Ecole $ecole)
            {
                $ecole->delete();
                return redirect()->route('ecoles-dash.index')->with('success', 'Ecole deleted successfully.');
            }





        }
