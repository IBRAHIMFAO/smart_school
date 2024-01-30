<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next , $role)
    // {
    //     $user = $request->user();

    //     if ($user && $user->role === 'admin') {
    //         return $next($request); // Allow admin users
    //     }

    //     if ($user && $user->role === 'directeur') {
    //         return $next($request); // Allow directeur users
    //     }

    //     if ($user && $user->role === 'surveillant') {
    //         return $next($request); // Allow surveillant users
    //     }

    //     if ($user && $user->role === 'caissier' && $role === 'caissier') {
    //         return $next($request); // Allow caissier users only for 'dash-caissier'
    //     }

    //         // if (auth()->check() && !auth()->user()->hasRole('student')) {
    //         //     return redirect()->route('home'); // Redirect to the home page if the user is not a student
    //         // }

    //         if ($user && $user->role === 'student') {
    //             return $next($request); // Allow caissier users only for 'dash-caissier'
    //         }

    //         return $next($request);

    //     return redirect('/home'); // Redirect unauthorized users to the home page or a custom page



    // }





    public function handle($request, Closure $next, $role)
    {
        // if ($request->user()->hasRole($role)) {
        //     if ($role === 'student' || $role === 'tuteur') {
        //         return redirect()->route('student.home');
        //     } else {
        //         return redirect()->route('/');
        //     }
        // }

        // return $next($request);

        if (auth()->check() && auth()->user()->role === $role) {
            if (in_array($role, ['student', 'tuteur'])) {
                return redirect()->route('student.home');
            } elseif (in_array($role, ['superadmin', 'directeur', 'surveillant'])) {
                return redirect()->route('/');
            }
        }

        return $next($request);
        
    }








}
