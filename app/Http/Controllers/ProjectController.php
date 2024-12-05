<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Office;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectOwner;
use App\Models\Attachment;
use App\Models\ProjectModules;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Log;
use Arr;

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
        $projects = $query->with(['user', 'office'])->paginate(5);


        return view('projects.index', compact('projects'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::where('is_active', 1)->get();
        $users = User::where('is_active', 1)->role('developer')->get();
        $managers = User::where('is_active', 1)->role('project manager')->get();
        return view('projects.create', compact('users', 'offices', 'managers'));
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

            'focal_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',

            'project_manager' => 'required|exists:users,id',
            'tech_stack' => 'nullable|string|max:255',
            'estimate_deployment' => 'nullable|date',
            'deployment_date' => 'nullable|date',
            'version' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'public_link' => 'nullable|string|url|max:255',
            'admin_link' => 'nullable|string|url|max:255',
            'sad_files' => 'nullable|array',
            'sad_files.*' => 'nullable|file|mimes:pdf|max:2048',
            'deployment_files' => 'nullable|array',
            'deployment_files.*' => 'nullable|file|mimes:pdf|max:2048',
            'agreement_files' => 'nullable|array',
            'agreement_files.*' => 'nullable|file|mimes:pdf|max:2048',
            'form_files' => 'nullable|array',
            'form_files.*' => 'nullable|file|mimes:pdf|max:2048',
            'google_remarks' => 'nullable|string|max:255',
            'seo_comments' => 'nullable|string|max:255',
            'dpa_remarks' => 'nullable|string|max:255',

            'module_name_1' => 'nullable|string|max:255',
            'start_date_1' => 'nullable|date',
            'end_date_1' => 'nullable|date',
            'module_status_1' => 'nullable|string|max:255',
            'version_level_1' => 'nullable|string|max:255',
            'user_id_1' => 'nullable|exists:users,id',
            'dev_remarks_1' => 'nullable|string|max:255',

            'module_name_2' => 'nullable|string|max:255',
            'start_date_2' => 'nullable|date',
            'end_date_2' => 'nullable|date',
            'module_status_2' => 'nullable|string|max:255',
            'version_level_2' => 'nullable|string|max:255',
            'user_id_2' => 'nullable|exists:users,id',
            'dev_remarks_2' => 'nullable|string|max:255',

            'module_name_3' => 'nullable|string|max:255',
            'start_date_3' => 'nullable|date',
            'end_date_3' => 'nullable|date',
            'module_status_3' => 'nullable|string|max:255',
            'version_level_3' => 'nullable|string|max:255',
            'user_id_3' => 'nullable|exists:users,id',
            'dev_remarks_3' => 'nullable|string|max:255',
        ],);

        //dd($data);

        // First, check if a project owner with the given focal person and contact exists
        $projectOwner = ProjectOwner::firstOrCreate([
            'focal_person' => $request->focal_person ?? '', 
            'contact_number' => $request->contact_number ?? '',
        ],

        [
            'office_id' => $request->office_id,
        ]);

        //dd($projectOwner);

        $project = Project::create([
            'project_name' => $data['project_name'],
            'description' => $data['description'] ?? '',
            'office_id' => $data['office_id'],
            'user_id' => $data['user_id'],
            'project_owner_id' => $projectOwner->id,
            'project_manager' => $data['project_manager'],
            'tech_stack' => $data['tech_stack'] ?? '',
            'estimate_deployment' => $data['estimate_deployment'] ?: null,
            'deployment_date' => $data['deployment_date'] ?: null,
            'version' => $data['version'] ?? '',
            'status' => $data['status'] ?? '',
            'public_link' => $data['public_link'] ?? '',
            'admin_link' => $data['admin_link'] ?? '',
            'google_remarks' => $data['google_remarks'] ?? '',
            'seo_comments' => $data['seo_comments'] ?? '',
            'dpa_remarks' => $data['dpa_remarks'] ?? '',
        ]);

        //dd($project);

        

        $this->handleAttachments($request, $project, 'sad_files');
        $this->handleAttachments($request, $project, 'deployment_files');
        $this->handleAttachments($request, $project, 'agreement_files');
        $this->handleAttachments($request, $project, 'form_files');

    $modules = [];

    for ($i = 1; $i <= 3; $i++) {
        if ($request->input("module_name_$i")) { // Check if the module name is provided
            $modules[] = [
                'project_id' => $project->id,
                'module_name' => $request->input("module_name_$i"),
                'start_date' => $request->input("start_date_$i"),
                'end_date' => $request->input("end_date_$i"),
                'module_status' => $request->input("module_status_$i"), // Default if null
                'version_level' => $request->input("version_level_$i"),
                'user_id' => $request->input("user_id_$i"),
                'dev_remarks' => $request->input("dev_remarks_$i"),
            ];
        }
    }

    // Save each module to the database
    foreach ($modules as $moduleData) {
        ProjectModules::create($moduleData);
    }

    // Handle attachments (if any)
    if ($request->hasFile('attachment')) {
        foreach ($request->file('attachment') as $file) {
            
        }
    }

    // Log the activity
    activity()
        ->performedOn($project)
        ->log(auth()->user()->username . ' (' . auth()->user()->first_name . ' ' .
             auth()->user()->middle_name . ' ' . auth()->user()->last_name . ')' .
             ' created a new project: ' . $project->project_name);

    return redirect(route('projects.index'))->with('status', 'Successfully added project!');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::with('modules', 'attachments')->findOrFail($id);
        $activities = $project->activities()->latest()->get();
        return view('projects.details', compact('project', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $offices = Office::where('is_active', 1)->get();
        $users = User::where('is_active', 1)->role('developer')->get();
        $managers = User::where('is_active', 1)->role('project manager')->get();
        
        $project->load('owner', 'modules');

        return view('projects.edit', ['project' => $project, 'users' => $users, 'offices' => $offices, 'managers' => $managers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, ProjectOwner $owner, ProjectModules $modules)
    {
        $data = $request->validate([
            'tech_stack' => 'nullable|string|max:255',
            'estimate_deployment' => 'nullable|date',
            'deployment_date' => 'nullable|date',
            'version' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'public_link' => 'nullable|string|url|max:255',
            'admin_link' => 'nullable|string|url|max:255',
            'sad_files' => 'nullable|array',
            'sad_files.*' => 'nullable|file|mimes:pdf|max:2048',
            'deployment_files' => 'nullable|array',
            'deployment_files.*' => 'nullable|file|mimes:pdf|max:2048',
            'agreement_files' => 'nullable|array',
            'agreement_files.*' => 'nullable|file|mimes:pdf|max:2048',
            'form_files' => 'nullable|array',
            'form_files.*' => 'nullable|file|mimes:pdf|max:2048',
            'google_remarks' => 'nullable|string|max:255',
            'seo_comments' => 'nullable|string|max:255',
            'dpa_remarks' => 'nullable|string|max:255',

            'modules' => 'array',
            'modules.*.module_name' => 'nullable|string|max:255',
            'modules.*.start_date' => 'nullable|date',
            'modules.*.end_date' => 'nullable|date',
            'modules.*.module_status' => 'nullable|string|max:255',
            'modules.*.version_level' => 'nullable|string|max:255',
            'modules.*.user_id' => 'nullable|exists:users,id',
            'modules.*.dev_remarks' => 'nullable|string|max:255',
        ],);

        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('project manager')){
            $data = array_merge($data, $request->validate([
                'project_name' => 'required|string|max:255|unique:projects,project_name,' . $project->id,
                'description' => 'nullable|string|max:255',
                'office_id' => 'required|exists:offices,id',
                'user_id' => 'required|exists:users,id',
                'focal_person' => 'required|string|max:255',
                'contact_number' => 'required|string|max:255',
                'project_manager' => 'required|exists:users,id',
            ]));
        }
        
        $old = $project->getOriginal();
        $oldProjectModule = $project->modules()->first()->getOriginal();
        $owner = $project->owner;
        
        $project->update($data);

        // Ensure focal_person and contact_number are set before using them
        $focalPerson = Arr::get($data, 'focal_person');
        $contactNumber = Arr::get($data, 'contact_number');

        $owner->update([
            'focal_person'  => $focalPerson,
            'contact_number' => $contactNumber,
        ]);

        // Update existing module
        $modules = $request->input('modules', []);
        foreach ($project->modules as $index => $module) {
            if (isset($modules[$index])) {
                $module->update($modules[$index]);
            }
        }  

        // Create new modules if needed
        for ($i = count($project->modules); $i < count($modules); $i++) {
            // Create new module linked to the project
            $project->modules()->create($modules[$i]);
        }
        
        // Remove file fields from $data to avoid updating them with the project update
        $fileFields = ['sad_files', 'deployment_files', 'agreement_files', 'form_files'];
        foreach ($fileFields as $fileField) {
            unset($data[$fileField]);
        }

        $this->handleAttachments($request, $project, 'sad_files');
        $this->handleAttachments($request, $project, 'deployment_files');
        $this->handleAttachments($request, $project, 'agreement_files');
        $this->handleAttachments($request, $project, 'form_files');


        $projectChanges = collect($project->getChanges())->except('updated_at');
        $ownerChanges = collect($owner->getChanges())->except('updated_at');
        $projectModuleChanges = [];
        
        $comparableKeys = [
            'module_name', 'start_date', 'end_date',
            'module_status', 'version_level', 'user_id', 'dev_remarks'
        ];
        //dd($request->all());

        foreach ($modules as $index => $module) {
            // Ensure we are accessing the correct data in $oldProjectModule
            $oldModule = $oldProjectModule[$index] ?? [];  // Ensure it's correctly structured as per $index

            foreach ($comparableKeys as $key) {
                $newValue = $module[$key] ?? null;
                $oldValue = $oldModule[$key] ?? null;

                if ($newValue !== $oldValue) {
                    $projectModuleChanges[$key] = $newValue;
        
                    // Debugging log for key-value comparison
                    //logger()->info("Key: $key | Old: " . json_encode($oldValue) . " | New: " . json_encode($newValue));
                }
            }
        }
        
        $new = $projectChanges->merge($ownerChanges)->merge($projectModuleChanges);
        
        // Check if the update actually contains any project-related fields (ignoring `updated_at`)
        $fieldsChanged = $new->keys()->filter(function($key) {
            return in_array($key, ['description', 'tech_stack', 'public_link', 'admin_link',
            'google_remarks', 'seo_comments', 'dpa_remarks', 'module_name', 'version_level', 
            'start_date', 'end_date', 'module_status', 'user_id', 'dev_remarks',]);
        });

        if(!empty($fieldsChanged)){
            $logs = auth()->user()->username . ' updated project: ';

            foreach ($new as $field => $newValue) {
                // Check if the old value exists for this field
                if (array_key_exists($field, $old)) {
                    $oldValue = $old[$field] ?? null;

                    // Check if the values are arrays
                    if (is_array($newValue)) {
                        $newValue = json_encode($newValue); // Convert array to JSON string
                    }

                    if (is_array($oldValue)) {
                        $oldValue = json_encode($oldValue); // Convert array to JSON string
                    }

                    if($newValue !== $oldValue){
                        $logs .= "$field changed from ". ($oldValue ?? 'N/A') ." to " . ($newValue ?? 'N/A') . "; ";
                    }
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

            // Log module-level changes
            foreach ($projectModuleChanges as $key => $newValue) {
                $module = $project->modules->firstWhere('id', $module[$key]['id'] ?? null); // Ensure $module[$key]['id'] exists
                if ($module) {
                    activity()
                        ->performedOn($module)
                        ->causedBy(auth()->user())
                        ->withProperties([
                            'new' => [$key => $newValue], // You might need to adjust how the data is structured here
                            'old' => collect($module->getOriginal())->only([$key])
                        ])
                        ->log("Module $key changed");
                }
            }
        }

        return redirect(route('projects.index'))->with('status','Successfully updated ' . $project->project_name);
    }


    private function handleAttachments($request, $project, $inputField){
        $fileFields = [
            'sad_files' => 'SAD',
            'deployment_files' => 'Deployment Letter',
            'agreement_files' => 'Deployment Agreement',
            'form_files' => 'Forms'
        ];
    
        foreach($fileFields as $inputField =>$label){
            if($request->hasFile($inputField)){
                foreach($request->file($inputField) as $file){
                    if ($file instanceof UploadedFile) {
                        $origname = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $filename = pathinfo($origname, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;
                        $path = 'uploads/';
                        $directory = public_path($path);
                        
        
                        // Ensure the directory exists
                        if (!is_dir($directory)) {
                            mkdir($directory, 0775, true); // Make the directory if it doesn't exist
                        }

                        try {
                            $file->move($directory, $filename);
    
                            Attachment::create([
                                'project_id' => $project->id,
                                'file_name' => $filename,
                                'file_path' => $path . $filename,
                                'uploaded_at' => now(),
                            ]);
    
                            activity()->on($project)->log(auth()->user()->username . ' added attachment (' . $label . '): ' . $filename);
                        } catch (\Exception $e) {
                            Log::error('File upload failed for: ' . $filename . '. Error: ' . $e->getMessage());
                        }
                            
                            
                        
                        
                    }
                }
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
