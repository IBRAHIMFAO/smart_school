<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Prof;
use App\Models\Filiere;
use App\Models\Departement;
use App\Models\Seance;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DepartementProf;
use Illuminate\Support\Facades\Log;

use PDF;


class dashProfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
         // Récupérez la liste des professeurs avec leurs données liées (département et utilisateur)
        //  $profs = Prof::with('user', 'departements')->get();
        // Récupérer tous les professeurs avec leurs départements et utilisateurs associés
        $profs = Prof::with(['departements', 'user'])->get();
         return view('profs-dash.index', compact('profs' ));
    }

    // public function generatePdf()
    // {
    //     ini_set('max_execution_time', 300);

    //     $profs = Prof::all();

    //     $html = view('profs-dash.pdf', compact('profs'));

    //     $pdf = PDF::loadHtml($html);
    //     // $pdf->SetFont('Helvetica');

    //     return $pdf->stream('profs.pdf');
    // }
    //     public function generatePDF()
    // {
    //     ini_set('max_execution_time', 300);

    //     $profs = Prof::all();

    //     // $pdf = PDF::loadView('profs-dash.pdf', compact('profs'));
    //     view()->share('profs', $profs);
    //     $pdf = PDF::loadView('profs-dash.pdf', $profs->toArray() )->setOptions(['defaultFont' => 'sans-serif']);


    //     return $pdf->stream('professors.pdf');
    //     // return $pdf->download('professors.pdf');


    //     // $pdf = PDF::loadView('reports.today', ['Data' => $Data])->setOptions(['defaultFont' => 'sans-serif']);


    //     // return $pdf->download('invoice.pdf');

    // }

        public function generatePDF()
    {
        $profs = Prof::all();

        $pdf = PDF::loadView('profs-dash.pdf', compact('profs'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('professors.pdf');


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Assuming you have a Department model to fetch department options
        $departements = Departement::all();

        return view('profs-dash.create' , compact('departements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {


    //     try {
    //         if (!array_key_exists('email', $request->input())) {
    //             throw new \Exception('The email field is required.');
    //         }
    // $validatedData = $request->validate([
    //     'first_name' => 'required|string|max:255',
    //     'last_name' => 'required|string|max:255',
    //     'first_name_ar' => 'nullable|string|max:255',
    //     'last_name_ar' => 'nullable|string|max:255',
    //     'hours_worked' => 'nullable|integer',
    //     'birthdate' => 'nullable|date',
    //     'cin' => 'nullable|string|unique:profs|max:255',
    //     'Doti' => 'nullable|string|unique:profs|max:255',
    //     'family_status' => 'nullable|string|max:255',
    //     'address' => 'nullable|string',
    //     'fullname' => 'required|string|max:255',
    //     'gender' => 'required|in:male,female',
    //     'img' => 'nullable|string',
    //     'role' => 'required|string',
    //     'phone' => 'nullable|string',
    //     'email' => 'required|email|unique:users',
    //     'password' => 'required|string',
    //     'is_active' => 'nullable|boolean',
    //     'departments' => 'nullable|array', // Assuming this is an array of department IDs
    // ]);



    //     // Create a new user
    //     $user = new User([
    //         'fullname' => $validatedData['fullname'] ,
    //         'gender' => $validatedData['gender'], // Assuming you have a 'gender' field
    //         // 'img' => $validatedData['img'], // Assuming you have an 'img' field
    //         'img' => $request->file('img')->store('user_images', 'public'), // Store the image in the 'public/user_images' directory
    //         'role' => 'prof', // Assuming all professors have the role 'prof'
    //         'phone' => $validatedData['phone'],
    //         'email' => $validatedData['email'],
    //         'password' => bcrypt($validatedData['password']), // Hash the password
    //         'is_active' => $validatedData['is_active'],
    //     ]);

    //     $user->save();

    //     // Create a new professor
    //     $user-> prof() -> create([
    //         'first_name' => $validatedData['first_name'],
    //         'last_name' => $validatedData['last_name'],
    //         'first_name_ar' => $validatedData['first_name_ar'],
    //         'last_name_ar' => $validatedData['last_name_ar'],
    //         'hours_worked' => $validatedData['hours_worked'],
    //         'birthdate' => $validatedData['birthdate'],
    //         'cin' => $validatedData['cin'],
    //         'Doti' => $validatedData['Doti'],
    //         'family_status' => $validatedData['family_status'],
    //         'address' => $validatedData['address'],
    //         'code_user' => $user->id, // Associate with the user
    //     ]);

    //     // // Save the professor
    //     // $professor->save();

    //     // Attach the selected departments to the professor
    //     $user->prof->departements()->attach($validatedData['departments']);

    //     return redirect()->route('dash-prof.index')->with('success', 'Professeur créé avec succès.');
    // } catch (\Exception $e) {

    //     return redirect()->back()
    //     ->with('error', 'Erreur lors de la création du professeur: ' . $e->getMessage())
    //     ->withInput()
    //     ->withErrors($e->getMessage());


    // }



    // }


    public function store(Request $request)
    {
        try {
            if (!array_key_exists('email', $request->input())) {
                throw new \Exception('The email field is required.');
            }

            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'first_name_ar' => 'nullable|string|max:255',
                'last_name_ar' => 'nullable|string|max:255',
                'hours_worked' => 'nullable|integer',
                'birthdate' => 'nullable|date',
                'cin' => 'nullable|string|unique:profs|max:255',
                'Doti' => 'nullable|string|unique:profs|max:255',
                'family_status' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'fullname' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max for the image
                'role' => 'required|string',
                'phone' => 'nullable|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
                'is_active' => 'nullable|boolean',
                'code_departements' => 'nullable|array', // Assuming this is an array of department IDs
            ]);

            // Create a new user
            $user = new User([
                'fullname' => $validatedData['fullname'],
                'gender' => $validatedData['gender'],
                'role' => 'prof',
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'is_active' => $validatedData['is_active'] ?? false,
            ]);

            $user->save();

            // Now that the user is created, handle the image upload
            if ($request->hasFile('img')) {
                $user->img = $request->file('img')->store('user_images', 'public');
                $user->save();
            }

            // Create a new professor associated with the user
            $professor = $user->prof()->create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'first_name_ar' => $validatedData['first_name_ar'],
                'last_name_ar' => $validatedData['last_name_ar'],
                'hours_worked' => $validatedData['hours_worked'],
                'birthdate' => $validatedData['birthdate'],
                'cin' => $validatedData['cin'],
                'Doti' => $validatedData['Doti'],
                'family_status' => $validatedData['family_status'],
                'address' => $validatedData['address'],
                'code_user' => $user->id, // Associate with the user
            ]);

            // Get the IDs of the selected departments from the form input
            // $selectedDepartmentIds = $request->input('code_departements');
            $selectedDepartmentIds = $validatedData['code_departements'] ;

            // Retrieve the departments with the selected IDs
            $selectedDepartments = Departement::whereIn('id', $selectedDepartmentIds)->get();

            // Insert the selected departments' labels into the departement_prof table
            foreach ($selectedDepartments as $department) {
                DepartementProf::create([
                    'code_prof' => $professor->id,
                    'code_departement' => $department->id,
                    'label' => $department->label,
                ]);
            }

            return redirect()->route('dash-prof.index')->with('success', 'Professeur créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la création du professeur: ' . $e->getMessage())
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
        $prof = Prof::findOrFail($id);
        return view('profs-dash.show', compact('prof'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function edit($id)
     {
         try {
             $professor = Prof::find($id);
             $departments = Departement::all();
             $selectedDepartments = $professor->departements()->pluck('code_departement')->toArray();

             return view('profs-dash.edit', compact('professor', 'departments', 'selectedDepartments'));
            // return view('profs-dash.edit', compact('professor'));

         } catch (\Exception $e) {
             return redirect()->route('dash-prof.index')
                 ->with('error', 'Erreur lors de la récupération du professeur: ' . $e->getMessage());
         }
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
             // Find the professor by ID
             $professor = Prof::find($id);

             $validatedData = $request->validate([
                'fullname' => 'required|string|max:255',
                 'first_name' => 'required|string|max:255',
                 'last_name' => 'required|string|max:255',
                 'first_name_ar' => 'nullable|string|max:255',
                 'last_name_ar' => 'nullable|string|max:255',
                 'hours_worked' => 'nullable|integer',
                 'birthdate' => 'nullable|date',
                 'cin' => 'nullable|string|max:255|unique:profs,cin,' . $id,
                 'Doti' => 'nullable|string|max:255|unique:profs,Doti,' . $id,
                 'family_status' => 'nullable|string|max:255',
                 'address' => 'nullable|string',
                 'gender' => 'required|in:male,female',
                 'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max for the image
                 'role' => 'required|string',
                 'phone' => 'nullable|string',
                 'email' => 'required|email|unique:users,email,' . $professor->user->id,  // Ignore the current user's email
                 'is_active' => 'nullable|boolean',
                 'password' => 'nullable|string|min:8',

                 'code_departements' => 'nullable|array', // Assuming this is an array of department IDs
             ]);



             if (!$professor) {
                 return redirect()->route('dash-prof.index')->with('error', 'Professeur introuvable.');
             }


             // Update the user associated with the professor
        $userUpdateData = [
            'fullname' => $validatedData['fullname'],
            'gender' => $validatedData['gender'],
            'role' => 'prof',
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'is_active' => $validatedData['is_active'] ?? false,
        ];

        // Handle password update if provided
        if (!empty($validatedData['password'])) {
            $userUpdateData['password'] = bcrypt($validatedData['password']);
        }

        $professor->user->update($userUpdateData);

             // Update the professor details
             $professor->update([
                 'first_name' => $validatedData['first_name'],
                 'last_name' => $validatedData['last_name'],
                 'first_name_ar' => $validatedData['first_name_ar'],
                 'last_name_ar' => $validatedData['last_name_ar'],
                 'hours_worked' => $validatedData['hours_worked'],
                 'birthdate' => $validatedData['birthdate'],
                 'cin' => $validatedData['cin'],
                 'Doti' => $validatedData['Doti'],
                 'family_status' => $validatedData['family_status'],
                 'address' => $validatedData['address'],
                //  'code_user' => $user->id, // Associate with the user

             ]);

             // Handle image upload
             if ($request->hasFile('img')) {
                 $professor->user->img = $request->file('img')->store('user_images', 'public');
                 $professor->user->save();
             }

             // Sync the selected departments
             $professor->departements()->sync($validatedData['code_departements']);

             return redirect()->route('dash-prof.index')->with('success', 'Professeur mis à jour avec succès.');
         } catch (\Exception $e) {
             return redirect()->back()
                 ->with('error', 'Erreur lors de la mise à jour du professeur: ' . $e->getMessage())
                 ->withInput()
                 ->withErrors($e->getMessage());
         }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     try {

    //     $prof = Prof::findOrFail($id);
    //     // $profs = Prof::with('departements')->findOrFail($id);
    //     // $prof->departements;
    //     $prof->destroy();
    // }catch (\Exception $e) {
    //     return redirect()->route('dash-prof.index')->with('success', 'Professeur supprimé avec succès')
    //         ->with('error', 'Erreur lors de la récupération du professeur: ' . $e->getMessage());
    // }

    // }

    // public function destroy($id)
    // {
    //     try {
    //         // Find the professor by ID
    //         $professor = Prof::find($id);
    //         // $professor = Prof::with('departements')->findOrFail($id);

    //         // dd($professor); // Add this line to check if professor is found


    //         if (!$professor) {
    //             return redirect()->route('dash-prof.index')->with('error', 'Professeur introuvable.');
    //         }

    //         // Delete the associated user
    //         // $professor->user->delete();

    //         // Optionally, you can also detach the departments if needed
    //         // $professor->departements()->detach();

    //         // Delete the professor
    //         $professor->delete();

    //         return redirect()->route('dash-prof.index')->with('success', 'Professeur supprimé avec succès.');
    //     } catch (\Exception $e) {
    //         return redirect()->route('dash-prof.index')
    //             ->with('error', 'Erreur lors de la suppression du professeur: ' . $e->getMessage());
    //     }
    // }


//     public function destroy($id)
// {
//     try {
//         // Find the professor by ID
//         $professor = Prof::find($id);

//         if (!$professor) {
//             return redirect()->route('dash-prof.index')->with('error', 'Professeur introuvable.');
//         }

//         // Delete the professor and related user record
//         $professor->user->delete();
//         $professor->delete();

//         return redirect()->route('dash-prof.index')->with('success', 'Professeur supprimé avec succès.');
//     } catch (\Exception $e) {
//         return redirect()->route('dash-prof.index')->with('error', 'Erreur lors de la suppression du professeur: ' . $e->getMessage());
//     }

        public function destroy($id)
        {
            // Find the professor by their ID
        $professor = Prof::find($id)->delete();

            return redirect()->route('dash-prof.index')->with('success', 'Professeur supprimé avec succès.');

            // if (!$professor) {
            //     return redirect()->route('dash-prof.index')->with('error', 'Professor not found.');
            // }

            // try {
            //     // Delete the professor
            //     $professor->delete();
            //     return redirect()->route('dash-prof.index')->with('success', 'Professor deleted successfully.');
            // } catch (\Exception $e) {
            //     return redirect()->route('dash-prof.index')->with('error', 'Error deleting professor: ' . $e->getMessage());
            // }
        }










    public function toggleAccountStatus($id)
    {
        $professor = Prof::find($id);

        // $user = User::findOrFail($professor->code_user);

        // Toggle the user's active status
        $professor->user->is_active = !$professor->user->is_active;
        $professor->user->save();

        return redirect()->route('dash-prof.index')->with('success', 'Account status toggled successfully.');

    }
}
