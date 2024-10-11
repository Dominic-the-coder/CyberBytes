<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show form to create a new user
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Store the new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show form to edit a user
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Update user details
    public function update(Request $request)
    {

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email,'.$user->id,
        //     'password' => 'nullable|string|min:6',
        //     'role_id' => 'required|integer'
        // ]);
        $user = User::findOrFail($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;

        // if ($request->password) {
        //     $user->password = Hash::make($request->password);
        // }
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
    
        return redirect()->back()->with('success', 'User deleted successfully');
    }
    

    // Delete a user
    // public function destroy($user)
    // {
    //     $user->delete();
    //     return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    // }
}
