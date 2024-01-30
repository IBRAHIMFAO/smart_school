<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $user = Auth::user();

            // Add your condition to check user's role type
            if ($user->role === 'admin') {
                return redirect('/');
            } elseif ($user->role === 'directeur') {
                return redirect('/');
            } elseif ($user->role === 'surveillance') {
                return redirect('/');
            } elseif ($user->role === 'caissier') {
                return redirect('/');
            } elseif ($user->role === 'student') {
                return redirect('/student/home');
            } else {
                return redirect('/home');
            }
            // Default redirect if role is not recognized


                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }




    


}
