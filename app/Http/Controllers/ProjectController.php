<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['status', 'user'])->get();
        $status = Status::all();
        return view('cpanel.projects.index', ['projects' => $projects, 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects,name',
        ], [
            'name.unique' => 'The project name already exists. Please choose another name.',
        ]);
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
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $status = Status::all();
        $user = User::all();
        return view('cpanel.projects.projectDetails', compact('project', 'status', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects,name,' . $project->id,
        ]);

        try {
            $project->update($request->only(['name', 'description', 'cost', 'start_date', 'deadline', 'status_id']));
            return redirect()->route('projects')->with('success', 'Project updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();
            return redirect()->route('projects')->with('success', 'Project deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
