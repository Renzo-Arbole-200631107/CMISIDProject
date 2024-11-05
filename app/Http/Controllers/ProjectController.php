<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Office;
use App\Models\User;
use App\Models\Project;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Project::query();

        if($user->hasRole('developer')){
            $query->where('user_id', $user->id);
        }

        // Filter by date range if both start and end dates are provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('start_sad', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            // If only start date is provided
            $query->where('start_sad', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            // If only end date is provided
            $query->where('start_sad', '<=', $request->end_date);
        }

        // Filter by status if a status is selected
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Handle search functionality
        if ($request->input('search')) {
            $search = strtolower($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(project_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(office_id) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(user_id) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->whereRaw('LOWER(first_name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(middle_name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$search}%"]);
                    });
            });
        }

        // Get the results with eager loading for the account relationship
        $projects = $query->with(['user', 'office'])->paginate(1);


        return view('projects.index', compact('projects'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::where('is_active', 1)->get();
        $users = User::all();
        return view('projects.create', compact('users', 'offices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_name' => 'required|string|max:255|unique:projects,project_name',
            'description' => 'nullable|string|max:255',
            'office_id' => 'required|exists:offices,id',
            'user_id' => 'required|exists:users,id',
            'designation' => 'nullable|string|max:255',
            'start_sad' => 'nullable|date',
            'start_dev' => 'nullable|date',
            'estimate_deployment' => 'nullable|date',
            'deployment_date' => 'nullable|date',
            'version' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'link' => 'nullable|string|url|max:255',
            'attachment' => 'nullable|array',
            'attachment.*' => 'nullable|file|mimes:docx,doc',
            'dev_remarks' => 'nullable|string|max:255',
            'google_remarks' => 'nullable|string|max:255',
            'seo_comments' => 'nullable|string|max:255',
            'dpa_remarks' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
        ],);

        //dd($data);

        $project = Project::create([
            'project_name' => $data['project_name'],
            'description' => $data['description'] ?? '',
            'office_id' => $data['office_id'],
            'user_id' => $data['user_id'],
            'designation' => $data['designation'] ?? '',
            'start_sad' => $data['start_sad'] ?: null,
            'start_dev' => $data['start_dev'] ?: null,
            'estimate_deployment' => $data['estimate_deployment'] ?: null,
            'deployment_date' => $data['deployment_date'] ?: null,
            'version' => $data['version'] ?? '',
            'status' => $data['status'] ?? '',
            'link' => $data['link'] ?? '',
            'dev_remarks' => $data['dev_remarks'] ?? '',
            'google_remarks' => $data['google_remarks'] ?? '',
            'seo_comments' => $data['seo_comments'] ?? '',
            'dpa_remarks' => $data['dpa_remarks'] ?? '',
            'remarks' => $data['remarks'] ?? '',
        ]);

        if ($request->hasFile('attachment')) {
            /** */
            foreach($request->file('attachment') as $file){
                //dd($file);
                if ($file instanceof UploadedFile) {
                    $origname = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($origname, PATHINFO_FILENAME) . '_' . time() . '.' . $extension;
                    $path = 'uploads/';

                    // Move the file to the specified directory
                    $file->move(public_path($path), $filename); // Use public_path to store files in the public directory
                }

                Attachment::create([
                    'project_id' => $project->id,
                    'file_name' => $filename,
                    'file_path' => $path . $filename,
                    'uploaded_at' => now(),
                ]);
            }
        }

        activity()
            ->performedOn($project)
            ->log(auth()->user()->username . '(' . auth()->user()->first_name . 
            auth()->user()->middle_name . auth()->user()->last_name . ')' . 
            ' created a new project: ' . $project->project_name);
        //->causedBy()

        return redirect(route('projects.index'))->with('status','Successfully added project!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);
        $activities = $project->activities()->latest()->get();
        $attachments = $project->attachments;
        return view('projects.details', compact('project', 'activities', 'attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $offices = Office::all();
        $users = User::all();
        return view('projects.edit', ['project' => $project, 'users' => $users, 'offices' => $offices]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //dd(vars: $request);
        $data = $request->validate([
            'project_name' => 'required|string|max:255|unique:projects,project_name,' . $project->id,
            'description' => 'nullable|string|max:255',
            'office_id' => 'required|exists:offices,id',
            'user_id' => 'required|exists:users,id',
            'designation' => 'nullable|string|max:255',
            'start_sad' => 'nullable|date',
            'start_dev' => 'nullable|date',
            'estimate_deployment' => 'nullable|date',
            'deployment_date' => 'nullable|date',
            'version' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'link' => 'nullable|string|url|max:255',
            'attachment' => 'nullable|array',
            'attachment.*' => 'nullable|file|mimes:docx,doc',
            'dev_remarks' => 'nullable|string|max:255',
            'google_remarks' => 'nullable|string|max:255',
            'seo_comments' => 'nullable|string|max:255',
            'dpa_remarks' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
        ]);

        $old = $project->getOriginal();
        $project->update($data);
        $new = collect($project->getChanges())->except('updated_at');

        if(!empty($new)){
            $logs = auth()->user()->username . ' (' . auth()->user()->first_name . ' ' . 
            auth()->user()->middle_name . ' ' . auth()->user()->last_name . ')' . ' updated project: ';
            foreach ($new as $field => $newValue) {
                // Check if the old value exists for this field
                if (isset($old[$field])) {
                    $oldValue = $old[$field];

                    // Append changes to the logs
                    $logs .= "$field changed from $oldValue to $newValue; ";
                }
            }



            activity()
            ->performedOn($project)
            ->causedBy(auth()->user())
            ->withProperties([
                'new' => $new,
                'old' => collect($old)->only($new->keys()->toArray()),
            ])
            ->log($logs);
        }

        if ($request->hasFile('attachment')) {
            /** */
            foreach($request->file('attachment') as $file){
                //dd($file);
                if ($file instanceof UploadedFile) {
                    $origname = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($origname, PATHINFO_FILENAME) . '_' . time() . '.' . $extension;
                    $path = 'uploads/';

                    // Move the file to the specified directory
                    $file->move(public_path($path), $filename); // Use public_path to store files in the public directory

                    // Log the activity for adding attachments
                    activity()->on($project)->log('Added attachment: ' . $filename);
                }

                Attachment::create([
                    'project_id' => $project->id,
                    'file_name' => $filename,
                    'file_path' => $path . $filename,
                    'uploaded_at' => now(),
                ]);
            }
        }

        return redirect(route('projects.index'))->with('status','Successfully updated ' . $project->project_name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
