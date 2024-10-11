<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accounts = Account::all();
        return view('projects.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'office_id' => 'required|exists:offices,id',
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'project_owner' => 'required|string|max:255',
            'developer_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'estimate_deployment' => 'required|date',
            'deployment_date' => 'required|date',
            'version' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'attachment' => 'required|string|max:255',
            'dev_remarks' => 'required|string|max:255',
            'google_remarks' => 'required|string|max:255',
            'seo_comments' => 'required|string|max:255',
            'dpa_remarks' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
        ]);

        $project = Project::create($data);
        $project = Project::create([
            'project_name' => $data['project_name'],
            'description' => $data['description'],
            'project_owner' => $data['project_owner'],
            'developer_name' => $data['developer_name'],
            'designation' => $data['designation'],
            'estimate_deployment' => $data['estimate_deployment'],
            'deployment_date' => $data['deployment_date'],
            'version' => $data['version'],
            'status' => $data['status'],
            'link' => $data['link'],
            'attachment' => $data['attachment'],
            'dev_remarks' => $data['dev_remarks'],
            'google_remarks' => $data['google_remarks'],
            'seo_comments' => $data['seo_comments'],
            'dpa_remarks' => $data['dpa_remarks'],
            'remarks' => $data['remarks'],
        ]);

        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
            $data['attachment'] = $filePath;
        }

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //return view('projects.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
