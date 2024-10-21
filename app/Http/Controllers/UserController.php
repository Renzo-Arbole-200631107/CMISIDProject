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
            $users = User::all();
        }

        return view('users.index', compact('users'));
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
            'is_admin' => 'required|integer',
            'is_active' => 'required|integer'
        ]);

        $user->update($data);
        return redirect(route('users.index'));
    }
}
