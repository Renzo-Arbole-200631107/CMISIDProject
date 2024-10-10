<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Role;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();

        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'is_admin' => 'required|integer',
            'is_active' => 'required|integer'
        ]);

        $account = Account::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'username' => $data['username'],
            'is_admin' => $data['is_admin'],
            'is_active' => $data['is_active'],
        ]);

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', ['account' => $account]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $data = $request->validate([
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'is_admin' => 'required|integer',
            'is_active' => 'required|integer'
        ]);

        $account->update($data);
        return redirect(route('accounts.index'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}
