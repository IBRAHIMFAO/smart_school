<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pavilion;

class dashPavilionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pavilions = Pavilion::all();
        return view('pavilions-dash.index', compact('pavilions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pavilions-dash.create');

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
                 'description' => 'nullable',
             ]);

             $pavilion = new Pavilion;
             $pavilion->label = $request->input('label');
             $pavilion->description = $request->input('description');
             $pavilion->save();

             return redirect()->route('dash-pavilion.index')->with('success', 'Pavilion ajouté avec succès.');
         } catch (\Exception $e) {
             return redirect()->route('dash-pavilion.create')->with('error', 'Une erreur est survenue lors de l\'ajout du Pavilion.')
                 ->with('error', $e->getMessage())
                 ->with('error', 'Veuillez réessayer et vérifier les données saisies.')
                 ->withInput()
                 ->withErrors($e->getMessage());
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
        $pavilion = Pavilion::findOrFail($id);
        return view('pavilions-dash.show', compact('pavilion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $pavilion = Pavilion::findOrFail($id);
    return view('pavilions-dash.edit', compact('pavilion'));
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
            'description' => 'nullable',
        ]);

        $pavilion = Pavilion::findOrFail($id);
        $pavilion->label = $request->input('label');
        $pavilion->description = $request->input('description');
        $pavilion->save();

        return redirect()->route('dash-pavilion.index')->with('success', 'Pavilion modifié avec succès.');
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
            $pavilion = Pavilion::find($id);

            if ($pavilion) {
                $pavilion->delete();
                return redirect()->route('dash-pavilion.index')->with('success', 'Pavilion supprimé avec succès.');
             } else {
                return redirect()->route('dash-pavilion.index')->with('error', 'Pavilion non trouvé.')
                    ->with('error', 'Veuillez réessayer et vérifier les données saisies.')
                    ->withInput()
                    ->withErrors('Pavilion non trouvé.');
            }
         } catch (\Exception $e) {
            return redirect()->route('dash-pavilion.index')->with('error', 'Une erreur s\'est produite lors de la suppression du pavilion.')
                ->with('error', $e->getMessage())
                ->with('error', 'Veuillez réessayer et vérifier les données saisies.')
                ->withInput()
                ->withErrors($e->getMessage());
         }
     }

}
