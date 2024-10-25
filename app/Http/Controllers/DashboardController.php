<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the count of projects by status
        $statusCounts = [
            'Cancelled' => Project::where('status', 'Cancelled')->count(),
            'Ongoing' => Project::where('status', 'On-going development')->count(),
            'ForDeployment' => Project::where('status', 'For Deployment')->count(),
            'ForUpdate' => Project::where('status', 'For Update')->count(),
            'Deployed' => Project::where('status', 'Deployed')->count(),
        ];

        // Pass the status counts to the dashboard view
        return view('dashboard', compact('statusCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
