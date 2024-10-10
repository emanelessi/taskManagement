<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Status;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=Project::with(['status','user'])->get();
        $status = Status::all();
        return view('projects.index', ['projects' => $projects, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Project::create([
                'name' => $request->name,
                'description' => $request->description,
                'status_id' => $request->status,
                'start_date' => $request->start_date,
                'deadline' => $request->deadline,
                'cost' => $request->cost,
                'created_by' => $request->user()->id,
            ]);
            return redirect()->route('projects')->with('success', 'Project added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }  }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::with('status', 'user')->findOrFail($id);
        return view('projects.projectDetails', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
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
