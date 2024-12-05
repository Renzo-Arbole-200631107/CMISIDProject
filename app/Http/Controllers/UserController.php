<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
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
                ->paginate();
        } else {
            $users = User::with('roles')->paginate(5);
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
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|string',
            'is_active' => 'required|integer',
            'designation' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'] ?? '',
            'username' => $data['username'],
            'is_active' => $data['is_active'],
            'designation' => $data['designation'] ?? '',
        ]);

        $user->assignRole($data['role']);

        //dd($user->roles);

        return redirect(route('users.index'))->with('status', 'Successfully added ' . $user->username);
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
            'last_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'is_active' => 'nullable|integer',
            'role' => 'nullable|string',
            'current_password' => 'nullable|required_with:password|string',
            'new_password' => 'nullable|min:8|confirmed',
            'designation' => 'nullable|string|max:255',
        ]);
        //dd($request->all());
        if ($request->has('role')) {
            $user->syncRoles([$request->input('role')]);
        }        
        $data['is_active'] = $request->has('is_active') ? $request->input('is_active') : $user->is_active;

        if($request->filled('current_password')){
            if(!Hash::check($request->current_password, $user->password)){
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
        }

        if($request->filled('new_password')){
            $data['password'] = Hash::make($request->new_password);
        }

        $user->update(Arr::except($data, ['current_password', 'new_password']));

        return redirect(route('users.index'))->with('status', 'Successfully updated ' . $user->username);
    }

    public function getChangePasswordForm(){
        return view('auth.change');
    }

    public function updatePassword(Request $request){
        $user = auth()->user();
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]+$/|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);
        $user->password_changed = true;
        $user->save();

        return redirect()->route('dashboard.index')->with('success', 'Password successfully updated!');
    }
}
