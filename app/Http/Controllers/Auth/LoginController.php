<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Add this line at the top of your LoginController
use App\Models\User;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/' ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Affiche le formulaire de connexion avec les rôles des utilisateurs
    public function showLoginForm()
    {
        $userRoles = User::distinct()->pluck('role'); // Use 'role' instead of 'type'
        return view('auth.login', compact('userRoles'));
    }

    
    // Tente la connexion en utilisant les crédits et le statut actif
    public function attemptLogin(Request $request)
    {
            $credentials = $this->credentials($request);
            $credentials['is_active'] = 1; // Check if the user is active

            // Attempt to log in with email, password, and active status
            // return $this->guard()->attempt(
            //     $credentials, $request->filled('remember')
            // );

            // Tente la connexion et envoie une réponse en cas de succès
            if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
                return $this->sendLoginResponse($request);
            }

            // Lance une exception avec un message en cas d'échec de connexion
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
    }

      // Gère la réponse en cas d'échec de connexion
    protected function sendFailedLoginResponse(Request $request)
    {
          // Lance une exception avec un message en cas d'échec de connexion
          throw ValidationException::withMessages([
              $this->username() => [trans('auth.failed')],
          ]);
    }

    
    // Récupère les crédits depuis la requête
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $request->input('role'), // Add role to credentials
        ];
    }


    // Gère la redirection après une connexion réussie
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('student')) {
            return redirect()->route('student.home');
        }

        return redirect('/'); // Redirect other users to the default home page
    }

}
