<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Project;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $attachments = $project->attachment;
        return view('attachments.index', compact('attachments', 'project'));
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
    public function store(Request $request, Project $project)
    {
        $request->validate([
             'attachment' => 'required|mimes:docx,doc',
        ]);

        if ($request->has('attachment')) {
            $file = $request->file('attachment');
            $origname = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $origname . '_' . time() . '.' . $extension;
            $path = 'uploads/';
            $file->move($path, $filename);

            Attachment::create([
                'project_id' => $project->id,
                'file_name' => $filename,
                'file_path' => $path . $filename,
                'uploaded_at' => now(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Attachment $attachment)
    {
        $request->validate([
            'attachment' => 'required|mimes:docx,doc',
       ]);

       if ($request->has('attachment')) {
           $file = $request->file('attachment');
           $origname = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
           $extension = $file->getClientOriginalExtension();
           $filename = $origname . '_' . time() . '.' . $extension;
           $path = 'uploads/';
           $file->move($path, $filename);

           Attachment::create([
               'project_id' => $project->id,
               'file_name' => $filename,
               'file_path' => $path . $filename,
               'uploaded_at' => now(),
           ]);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachment $attachment)
    {
        //
    }
}
