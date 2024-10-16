<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('account')->get();
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
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'project_owner' => 'required|string|max:255',
            'account_id' => 'required|exists:accounts,id',
            'designation' => 'required|string|max:255',
            'estimate_deployment' => 'required|date',
            'deployment_date' => 'required|date',
            'version' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'attachment' => 'required|mimes:docx,doc',
            'dev_remarks' => 'required|string|max:255',
            'google_remarks' => 'required|string|max:255',
            'seo_comments' => 'required|string|max:255',
            'dpa_remarks' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
        ]);

        if ($request->has('attachment')) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/';
            $file->move($path, $filename);
        }

        $project = Project::create([
            'project_name' => $data['project_name'],
            'description' => $data['description'],
            'project_owner' => $data['project_owner'],
            'account_id' => $data['account_id'],
            'designation' => $data['designation'],
            'estimate_deployment' => $data['estimate_deployment'],
            'deployment_date' => $data['deployment_date'],
            'version' => $data['version'],
            'status' => $data['status'],
            'link' => $data['link'],
            'attachment' => $path.$filename,
            'dev_remarks' => $data['dev_remarks'],
            'google_remarks' => $data['google_remarks'],
            'seo_comments' => $data['seo_comments'],
            'dpa_remarks' => $data['dpa_remarks'],
            'remarks' => $data['remarks'],
        ]);

        activity()
            ->performedOn($project)
            ->log('Created a new project:'.$project->project_name);
            //->causedBy()


        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);
        $activities = $project->activities()->latest()->get();
        return view('projects.details', compact('project', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $accounts = Account::all();
        return view('projects.edit', ['project' => $project, 'accounts'=>$accounts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'project_owner' => 'required|string|max:255',
            'account_id' => 'required|exists:accounts,id',
            'designation' => 'required|string|max:255',
            'estimate_deployment' => 'required|date',
            'deployment_date' => 'required|date',
            'version' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'attachment' => 'nullable|mimes:docx,doc',
            'dev_remarks' => 'required|string|max:255',
            'google_remarks' => 'required|string|max:255',
            'seo_comments' => 'required|string|max:255',
            'dpa_remarks' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
        ]);

        /**if($request->hasFile('attachment')){
            $destination = 'uploads/'.$project->attachment;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/';
            $file->move($path, $filename);
        }**/

        $project->update($data);

        activity()
            ->performedOn($project)
            ->log('Updated the project.');
        return redirect(route('projects.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
