<?php

namespace App\Http\Controllers;

use App\Models\Caissier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Superadmin;
use App\Models\Directeur;
use App\Models\Surveillant;
use App\Models\Prof;
use App\Models\Student;
use App\Models\Tuteur;
use App\Models\Ecole;


class ProfileController extends Controller
{



    public function showProfileForm()
    {
        $user = Auth::user();
        $role = $user->role;
        // $ecole = Ecole::where('code_ecole', $user->code_ecole)->first();
        if($role !== 'student' ){

            return view('profile', compact('user'));
        }else{
            $student = Student::where('code_user', $user->id)->first();
            // $ecole = Ecole::where('code_ecole', $student->code_ecole)->first();
            return view('student-pub.profile', compact('user', 'student'));
        }

        // return view('profile');
    }

    public function updateProfile(Request $request)
    {
        // $user = Auth::user();
         $user=User::find(Auth::user()->id);


        // $request->validate([
        //     'fullname' => ['required|string|max:255'],
        //     'first_name' => ['required|string|max:255'],
        //     'last_name' => ['required|string|max:255'],
        //     'email' => ['required|string|email|max:255|unique:users,email,' . $user->id, Rule::unique('users')->ignore($user->id)],
        //     'img' => ['nullable|image|mimes:jpeg,png,jpg,gif|max:2048'],
        //     'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        // ]);

            // Update user's data
            $user->fullname = $request->input('fullname');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');

            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            if ($request->hasFile('img')) {
                // Delete old image if exists
                if ($user->img && Storage::disk('public')->exists($user->img)) {
                    Storage::disk('public')->delete($user->img);
                }

                $user->img = $request->file('img')->store('images/profile_images', 'public');
                $user->save();
            }

            // Update user-specific data based on their role


        // Update user-specific data based on their role
        $role = $user->role;
        if ($role === 'superadmin') {
            $superadmin = Superadmin::where('code_user', $user->id)->first();
            if ($superadmin) {
                $superadmin->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                ]);
            }
        } elseif ($role === 'directeur') {
            $directeur = Directeur::where('code_user', $user->id)->first();
            if ($directeur) {
                $directeur->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                ]);
            }
        } elseif ($role === 'surveillance') {
            $surveillant = Surveillant::where('code_user', $user->id)->first();
            if ($surveillant) {
                $surveillant->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                ]);
            }
        } elseif ($role === 'prof') {
            $prof = Prof::where('code_user', $user->id)->first();
            if ($prof) {
                $prof->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                ]);
            }
        } elseif ($role === 'student') {
            $student = Student::where('code_user', $user->id)->first();
            if ($student) {
                $student->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                ]);
            }
        } elseif ($role === 'tuteur') {
            $tuteur = Tuteur::where('code_user', $user->id)->first();
            if ($tuteur) {
                $tuteur->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                ]);
            }
        }elseif ($role === 'caissier') {
            $caissier = Caissier::where('code_user', $user->id)->first();
            if ($caissier) {
                $caissier->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                ]);
            }
        }

        // if($role !== 'student' ){

        //     return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        // }elseif($role == 'student'){
        //     return redirect()->route('profile.')->with('success', 'Profile updated successfully!');
        // }
        // dd(Auth::user()->role);
        // return redirect()->route('profile',["role"=>Auth::user()->role])->with('success', 'Profile updated successfully.');

        return back();

    }
}
