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
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('deployment_date', [$request->start_date, $request->end_date]);
        }

        if ($request->input('search')) {
            $search = strtolower($request->input('search'));
            $query->whereRaw('LOWER(project_name) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(project_owner) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(account_id) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
                ->orWhereHas('account', function ($q) use ($search) {
                    $q->whereRaw('LOWER(first_name) LIKE ?', ["%{$search}%"])
                        ->orWhereRaw('LOWER(middle_name) LIKE ?', ["%{$search}%"])
                        ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$search}%"]);
                });
        }

        $projects = $query->with('account')->get();

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
            $filename = time() . '.' . $extension;
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
            'attachment' => $path . $filename,
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
        
        $old = $project->getOriginal();
        
        $project->update($data);

        $new = collect($project->getChanges())->except('updated_at');

        if(!empty($new)){
            $logs = 'Updated '.$project->project_name.': ';
            foreach ($new as $changes => $newLogs) {
                $logs .= $changes . ' changed from ' . $old[$changes] . ' to ' . $newLogs;
            }

            activity()
            ->performedOn($project)
            ->withProperties([
                'new' => $new,
                'old' => collect($old)->only($new->keys()->toArray()),
            ])
            ->log($logs);
        }

        
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
