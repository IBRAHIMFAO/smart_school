<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caissier;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class dashCaissierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caissiers = Caissier::with('user')->get(); // Load associated user data

        return view('caissiers-dash.index', compact('caissiers'));
    }
    public function toggleAccountStatus($id)
    {
        $caissier = Caissier::findOrFail($id);
        $user = User::findOrFail($caissier->code_user);

        // Toggle the 'is_active' status
        $user->is_active = !$user->is_active; // reverce etata
        $user->save();

        return redirect()->route('dash-caissier.index')->with('success', 'Account status toggled successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        // public function create()
        // {
        //     $caissiers = User::where('role', 'caissier')->get();
        //     return view('caissiers-dash.create', compact('caissiers'));
        // }
        public function create()
{
    // Check if the user has the role "admin" or "directeur"
    $user = auth()->user();

    if ($user->role === 'admin' || $user->role === 'directeur') {
        // If authorized, proceed to create a "caissier"
        // Fetch users with the role 'caissier' for selection
        $caissiers = User::where('role', 'caissier')->get();

        return view('caissiers-dash.create', compact('caissiers'));
    } else {
        // If not authorized, redirect or show an error message
        return redirect()->route('dash-caissier.index')->with('error', 'Vous n\'êtes pas autorisé à ajouter un caissier.');
    }
}




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        //     // Validate the incoming request data
        //     $validatedData = $request->validate([
        //         'fullname' => 'required|string|max:255',
        //         'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max for the image
        //         'first_name' => 'nullable|string|max:255',
        //         'last_name' => 'nullable|string|max:255',
        //         'first_name_ar' => 'nullable|string|max:255',
        //         'last_name_ar' => 'nullable|string|max:255',
        //         'cin' => 'nullable|string|max:255',
        //         'phone' => 'nullable|string|max:255',
        //         'email' => 'required|string|email|max:255|unique:users',
        //         'password' => 'required|string|min:8', // You may need to adjust the password requirements
        //         'birthdate' => 'nullable|date',
        //         'gender' => 'nullable|in:male,female',
        //         'NIF' => 'nullable|string|max:255',
        //         'salary' => 'nullable|numeric',
        //         'is_active' => 'nullable|boolean',
        //     ]);

        // // Set the role to 'caissier'
        // $validatedData['role'] = 'caissier';

        // // Upload and save the user's image
        // $imagePath = null;
        // if ($request->hasFile('img')) {
        //     $imagePath = $request->file('img')->store('user_images', 'public'); // Store the image in the 'public/user_images' directory
        // }

        //     // Create a new user
        //     $user = new User([
        //         'fullname' => $validatedData['fullname'],
        //         'email' => $validatedData['email'],
        //         'password' => Hash::make($validatedData['password']),
        //         'img' => $imagePath, // Save the image path
        //         'is_active' => isset($validatedData['is_active']) ? true : false, // Convert to boolean
        //         'phone' => $validatedData['phone'],
        //         'role' => $validatedData['role'],
        //         'gender' => $validatedData['gender'],

        //     ]);


        //     $user->save();

        //     // Create a new Caissier associated with the user
        //     $caissier = new Caissier([
        //         // 'fullname' => $validatedData['fullname'],
        //         // 'email' => $validatedData['email'],
        //         // 'password' => Hash::make($validatedData['password']),
        //         // 'img' => $imagePath, // Save the image path
        //         // 'is_active' => isset($validatedData['is_active']) ? true : false, // Convert to boolean
        //         // 'phone' => $validatedData['phone'],
        //         // 'role' => $validatedData['role'],
        //         // 'gender' => $validatedData['gender'],


        //         'first_name' => $validatedData['first_name'],
        //         'last_name' => $validatedData['last_name'],
        //         'first_name_ar' => $validatedData['first_name_ar'],
        //         'last_name_ar' => $validatedData['last_name_ar'],
        //         'cin' => $validatedData['cin'],
        //         'birthdate' => $validatedData['birthdate'],
        //         'NIF' => $validatedData['NIF'],
        //         'salary' => $validatedData['salary'],
        //         'code_user' => $user->id, // Associate the user with the Caissier
        //     ]);

        //     $user->caissier()->save($caissier);

        //     // Redirect to the index page or wherever you want after creating the Caissier
        //     return redirect()->route('dash-caissier.index')->with('success', 'Caissier créé avec succès');
        // }



        // public function store(Request $request)
        // {
        //     try {
        //         if (!array_key_exists('email', $request->input())) {
        //             throw new \Exception('The email field is required.');
        //         }


        //         // Validate the form data
        //         $validatedData = $request->validate([
        //             'fullname' => 'required|string|max:255',
        //             'first_name' => 'nullable|string|max:255',
        //             'last_name' => 'nullable|string|max:255',
        //             'cin' => 'nullable|string|max:255',
        //             'phone' => 'nullable|string|max:255',
        //             // 'email' => 'required|string|email|max:255|unique:users',
        //             'password' => 'required|string|min:8',
        //             'birthdate' => 'nullable|date',
        //             'gender' => 'nullable|in:male,female',
        //             'NIF' => 'nullable|string|max:255',
        //             'salary' => 'nullable|numeric',
        //             'is_active' => 'boolean',
        //             'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max for the image
        //         ]);


        //         // if (User::where('email', $validatedData['email'])->exists()) {
        //         //     throw new \Exception('The email address is already taken.');
        //         // }


        //         // Create a new user
        //         $user = User::create([
        //             'fullname' => $validatedData['fullname'],
        //             'email' => $validatedData['email'],
        //             'password' => bcrypt($validatedData['password']), // Hash the password
        //             'role' => 'caissier', // Set the role to "caissier"
        //             'is_active' => $validatedData['is_active'] ?? false, // Default to false if not provided
        //             'img' => $request->file('img')->store('user_images', 'public'), // Store the image in the 'public/user_images' directory
        //             'phone' => $validatedData['phone'],
        //             'gender' => $validatedData['gender'],
        //         ]);


        //         // Create a new Caissier record
        //         $caissier = Caissier::create([
        //             'first_name' => $validatedData['first_name'],
        //             'last_name' => $validatedData['last_name'],
        //             'first_name_ar' => $validatedData['first_name_ar'],
        //             'last_name_ar' => $validatedData['last_name_ar'],
        //             'NIF' => $validatedData['NIF'],
        //             'birthdate' => $validatedData['birthdate'],
        //             'cin' => $validatedData['cin'],
        //             'salary' => $validatedData['salary'],
        //             'code_user' => $user->id, // Associate the user with the Caissier
        //         ]);

        //         return redirect()->route('dash-caissier.index')
        //             ->with('success', 'Caissier créé avec succès.');
        //     }
        //     catch (\Exception $e) {
        //         return redirect()->back()
        //             ->with('error', 'Erreur lors de la création du Caissier: ' . $e->getMessage())
        //             ->withInput()
        //             ->withErrors($e->getMessage());
        //     }
        // }


        public function store(Request $request)
{
    try {
        if (!array_key_exists('email', $request->input())) {
            throw new \Exception('The email field is required.');
        }

        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'NIF' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max for the image
        ]);

        $user = User::create([
            'fullname' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Hash the password
            'role' => 'caissier', // Set the role to "caissier"
            'is_active' => $validatedData['is_active'] ?? false, // Default to false if not provided
            'img' => $request->file('img')->store('user_images', 'public'), // Store the image in the 'public/user_images' directory
            'phone' => $validatedData['phone'],
            'gender' => $validatedData['gender'],

        ]);

        // $caissier = Caissier::create
        // Merge the Caissier fields into the User record
        $user->caissier()->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'first_name_ar' => $validatedData['first_name_ar'],
            'last_name_ar' => $validatedData['last_name_ar'],
            'NIF' => $validatedData['NIF'],
            'birthdate' => $validatedData['birthdate'],
            'cin' => $validatedData['cin'],
            'salary' => $validatedData['salary'],
            // 'code_user' => $user->id, // Associate the user with the Caissier
        ]);

        return redirect()->route('dash-caissier.index')
            ->with('success', 'Caissier créé avec succès.');
    }
    catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Erreur lors de la création du Caissier: ' . $e->getMessage())
            ->withInput()
            ->withErrors($e->getMessage());
    }
}





        // Redirect to the index page or wherever you want after creating the Caissier




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
