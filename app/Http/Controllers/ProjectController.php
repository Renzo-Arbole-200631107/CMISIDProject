<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\Project;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::query();

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
                    ->orWhereRaw('LOWER(project_owner) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(account_id) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('account', function ($q) use ($search) {
                        $q->whereRaw('LOWER(first_name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(middle_name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$search}%"]);
                    });
            });
        }

        // Get the results with eager loading for the account relationship
        $projects = $query->with('user')->get();

        return view('projects.index', compact('projects'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('projects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        $data = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'project_owner' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'designation' => 'required|string|max:255',
            'start_sad' => 'required|date',
            'estimate_deployment' => 'required|date',
            'deployment_date' => 'required|date',
            'version' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'attachment' => 'nullable|array',
            'attachment.*' => 'nullable|file|mimes:docx,doc',
            'dev_remarks' => 'required|string|max:255',
            'google_remarks' => 'required|string|max:255',
            'seo_comments' => 'required|string|max:255',
            'dpa_remarks' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
        ]);

        //dd($data);

        $project = Project::create([
            'project_name' => $data['project_name'],
            'description' => $data['description'],
            'project_owner' => $data['project_owner'],
            'user_id' => $data['user_id'],
            'designation' => $data['designation'],
            'start_sad' => $data['start_sad'],
            'estimate_deployment' => $data['estimate_deployment'],
            'deployment_date' => $data['deployment_date'],
            'version' => $data['version'],
            'status' => $data['status'],
            'link' => $data['link'],
            'dev_remarks' => $data['dev_remarks'],
            'google_remarks' => $data['google_remarks'],
            'seo_comments' => $data['seo_comments'],
            'dpa_remarks' => $data['dpa_remarks'],
            'remarks' => $data['remarks'],
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
            ->log('Created a new project:' . $project->project_name);
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
        $users = User::all();
        return view('projects.edit', ['project' => $project, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //dd(vars: $request);
        $data = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'project_owner' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'designation' => 'required|string|max:255',
            'start_sad' => 'required|date',
            'estimate_deployment' => 'required|date',
            'deployment_date' => 'required|date',
            'version' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'attachment' => 'nullable|array',
            'attachment.*' => 'nullable|file|mimes:docx,doc',
            'dev_remarks' => 'required|string|max:255',
            'google_remarks' => 'required|string|max:255',
            'seo_comments' => 'required|string|max:255',
            'dpa_remarks' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
        ]);
       
        $old = $project->getOriginal();
        $project->update($data);
        $new = collect($project->getChanges())->except('updated_at');

        if(!empty($new)){
            $logs = 'Updated '.$project->project_name.': ';
            foreach ($new as $changes => $newLogs) {
                // Assuming $changes is an array
                if (is_array($changes)) {
                    $changesStr = implode(', ', $changes); // Convert array to a string
                } else {
                    $changesStr = $changes; // Keep it as is if it's already a string
                }

                if (isset($old[$changesStr]) && isset($newLogs[$changesStr])) {
                    $logs .= $changesStr . ' changed from ' . $old[$changesStr] . ' to ' . $newLogs[$changesStr] . '; ';
                }
            }

            activity()
            ->performedOn($project)
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
