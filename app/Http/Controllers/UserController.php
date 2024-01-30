<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('create-user')) {
            return view('users.create');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation logic here

        if (Gate::allows('create-user')) {
            // Create user logic here
            return redirect()->route('users.index')->with('success', 'User created successfully');
        } else {
            abort(403, 'Unauthorized action.');
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
         $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if (Gate::allows('edit-user')) {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        } else {
            abort(403, 'Unauthorized action.');
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
        if (Gate::allows('edit-user')) {
            // Update user logic here
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('delete-user')) {
            // Delete user logic here
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    
    
    public function toggleAccountStatus($id)
    {
        $user = User::find($id);

        // $user = User::findOrFail($professor->code_user);

        // Toggle the user's active status
           $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Account status toggled successfully.');

    }
}
