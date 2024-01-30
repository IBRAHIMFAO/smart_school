<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Caissier;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Superadmin;
use App\Models\Surveillant;
use App\Models\Directeur;
use App\Models\Prof;
use App\Models\Student;
use App\Models\Tuteur;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'cne'       =>['required', 'string', 'max:15'],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'img' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'], // Add this line
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'in:male,female'], // Change 'type' to 'gender'
            // 'role' => ['required', 'string', 'in:admin,directeur,surveillant,student,tuteur,caissier'], // Add 'role' field
            'role' => ['required', 'string', 'in:student'], // Add 'role' field
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'img' => $data['img']->store('images/profile_images', 'public'), // Store the uploaded image
            'phone' => $data['phone'],
            'gender' => $data['gender'], // Change 'type' to 'gender'
            'role' => $data['role'], // Add 'role' field
            'is_active' => ($data['role'] === 'superadmin') ? 1 : 0, // Set is_active to 1 for superadmin, 0 otherwise
        ]);




    if ($data['role'] === 'superadmin') {
        Superadmin::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'code_user' => $user->id,
        ]);
    // } elseif ($data['role'] === 'surviant') {
    } elseif ($data['role'] === 'surveillant') {
        Surveillant::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'code_user' => $user->id,
        ]);
    } elseif ($data['role'] === 'directeur') {
        Directeur::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'code_user' => $user->id,
        ]);
    } elseif ($data['role'] === 'prof') {
        Prof::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'code_user' => $user->id,
        ]);
    } elseif ($data['role'] === 'student') {
        Student::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'cne' => $data['cne'],
            'code_user' => $user->id,
        ]);
    } elseif ($data['role'] === 'tuteur') {
        Tuteur::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'code_user' => $user->id,
        ]);
    }elseif ($data['role'] === 'caissier') {
        Caissier::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'code_user' => $user->id,
        ]);
    };


    return $user;

    }

    // Override the default register method to include the new fields
    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     $user = $this->create($request->all());

    //     $this->guard()->login($user);

    //     return $this->registered($request, $user)
    //         ?: redirect($this->redirectPath());
    // }
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        try {
            $user = $this->create($request->all());
            $this->guard()->login($user);
            
            return $this->registered($request, $user) ?: redirect($this->redirectPath());
        } catch (\Exception $e) {
            // Log the exception (you can customize this based on your logging setup)
            \Log::error('Registration failed: ' . $e->getMessage());

            // Add an error message for the user
            return redirect()->back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }


}
