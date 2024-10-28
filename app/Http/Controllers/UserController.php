<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){

        $query = $request->input('search');

        if ($query) {
            $users = User::where('first_name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%")
                ->orWhere('middle_name', 'like', "%{$query}%")
                ->orWhere('first_name', 'like', "%{$query}%")
                ->get();
        } else {
            $users = User::with('roles')->paginate(1);
        }

        return view('users.index', compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){

        $data = $request->validate([
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'role' => 'required|string',
            'is_active' => 'required|integer'
        ]);

        $user = User::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'username' => $data['username'],
            'is_active' => $data['is_active'],
        ]);

        $user->assignRole($data['role']);

        //dd($user->roles);

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'is_active' => 'required|integer'
        ]);

        $user->update($data);
        $user->syncRoles($request->role);

        return redirect(route('users.index'));
    }
}
