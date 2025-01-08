<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $offices = Office::where('office_name', 'like', "%{$query}%")
                ->paginate();
        } else {
            $offices = Office::paginate(5);
        }
        // Fetch all offices from the database
        

        // Pass the offices data to the view
        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::all();
        return view('offices.create', compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'office_name' => 'required|string|max:255|unique:offices,office_name',
            'is_active' => 'required|integer'
        ]);

        $office = Office::create([
            'office_name' => $data['office_name'],
            'is_active' => $data['is_active'],
        ]);

        return redirect(route('offices.index'))->with('status', 'Successfully added ' . $office->office_name);
    }


    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        return view('offices.edit', ['office' => $office]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        $data = $request->validate([
            'office_name' => 'required|string|max:255|unique:offices,office_name,' . $office->id,
            'is_active' => 'required|integer'
        ]);

        $office->update($data);
        return redirect(route('offices.index'))->with('status', 'Successfully updated ' . $office->office_name);
    }

    public function similar(Request $request) {
        $query = $request->input('query');
        $offices = Office::where('office_name', 'LIKE', "%{$query}%")->pluck('office_name');
        return response()->json($offices);
    }
    
}
