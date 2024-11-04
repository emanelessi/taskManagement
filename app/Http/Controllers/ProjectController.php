<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function __construct()
//    {
//        $this->authorizeResource(Project::class, 'project', [
//            'show' => 'viewProjectDetails',
//        ]);
//    }

    public function index(Request $request)
    {
        $query = $request->input('search');
        $projects = Project::where('name', 'like', "%$query%")
            ->orWhereHas('status', function($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhereHas('user', function($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })->orWhere('cost', 'like', "%$query%")
            ->paginate(10);

        $status = Status::all();
        return view('cpanel.projects.index', ['projects' => $projects, 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);
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
        $this->authorize('viewProjectDetails', $project);
        $status = Status::all();
        $user = User::all();
        $tasks = $project->tasks;
        return view('cpanel.projects.projectDetails', compact('project', 'tasks', 'status', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
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
        $project = Project::findOrFail($id);
        $this->authorize('delete', $project);
        try {
            $project->delete();
            return redirect()->route('projects')->with('success', 'Project deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function projectReport(Project $project)
    {
        $this->authorize('viewProjectReport', $project);

        $projectNames = Project::select('name')->distinct()->pluck('name');
        $statuses = Project::with('status')->get()->pluck('status.name')->unique();

        $costs = Project::select('cost')->distinct()->pluck('cost');
        $createdBys = Project::with('user')->get()->pluck('user.name')->unique();

        return view('cpanel.reports.projects.index', compact('projectNames', 'statuses', 'costs', 'createdBys'));
    }


    public function projectPdf(Request $request)
    {
        try {
            $query = Project::query();

            if ($request->filled('project_name')) {
                $query->where('name', $request->input('project_name'));
            }
            if ($request->filled('status')) {
                $query->whereHas('status', function ($q) use ($request) {
                    $q->where('name', $request->input('status'));
                });
            }
            if ($request->filled('start_date')) {
                $query->where('start_date', $request->input('start_date'));
            }
            if ($request->filled('deadline')) {
                $query->where('deadline', $request->input('deadline'));
            }
            if ($request->filled('cost')) {
                $query->where('cost', $request->input('cost'));
            }
            if ($request->filled('created_by')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', $request->input('created_by'));
                });
            }
            if ($request->filled('from_date')) {
                $query->whereDate('created_at', '>=', $request->input('from_date'));
            }
            if ($request->filled('to_date')) {
                $query->whereDate('created_at', '<=', $request->input('to_date'));
            }
            $projects = $query->get();
            if ($projects->isEmpty()) {
                return redirect()->back()->withErrors(['msg' => __('filters no match')]);
            }

            $data = [
                'projects' => $projects,
                'title' => $request->input('title', __('project report')),
                'content' => $projects->count(),
            ];

            $pdf = Pdf::loadView('cpanel.reports.projects.pdf.projectReport', $data);
            return $pdf->download('report.pdf');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

}
