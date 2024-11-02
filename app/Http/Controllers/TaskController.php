<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::all();
        $categories = Category::all();
        $statuses = Status::all();

        $tasksQuery = Task::with(['project', 'comments', 'attachments', 'user', 'category', 'status']);
        $query = $request->input('search');

        // Adjust the query for tasks
        $tasks = $tasksQuery->where('title', 'like', "%$query%")
            ->orWhereHas('project', function($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhereHas('status', function($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhereHas('user', function($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhere('priority', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->paginate(10);

        // Assign a default value to $task to avoid "Undefined variable" error
        $task = null;

        foreach ($tasks as $t) {
            $t->first_image_attachment = $t->attachments->isNotEmpty()
                ? $t->attachments->first(function ($attachment) {
                    return preg_match('/\.(jpg|jpeg|png|gif)$/i', $attachment->file_path);
                })
                : null;
        }

        return view('cpanel.tasks.index', [
            'tasks' => $tasks,
            'projects' => $projects,
            'categories' => $categories,
            'statuses' => $statuses,
            'task' => $task, // Pass the default value
        ]);
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        try {
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'priority' => $request->priority,
                'category_id' => $request->category_id,
                'status_id' => $request->status_id,
                'project_id' => $request->project_id,
                'completed_at' => $request->completed_at,
                'assigned_to' => $request->user()->id,
            ]);
            return redirect()->back()->with('success', 'Task added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $project = Project::all();
        $attachment = $task->attachments;
        $comments = $task->comments;
        $category = Category::all();
        $status = Status::all();
        $user = User::all();
        return view('cpanel.tasks.taskDetails', compact('task', 'comments', 'attachment', 'category', 'project', 'status', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        try {
            $task->update($request->only(['title', 'description', 'due_date', 'priority', 'category_id', 'status_id', 'project_id', 'completed_at', 'assigned_to']));
            return redirect()->back()->with('success', 'Tasks updated successfully!');
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
            $task = Task::findOrFail($id);
            $task->delete();
            return redirect()->route('tasks')->with('success', 'Task deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function updateCategory(Request $request, Task $task)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        // تحديث الفئة للمهمة
        $task->category_id = $request->category_id;
        $task->save();

        // إرسال استجابة نجاح
        return response()->json(['success' => true]);
    }


    public function tasksByProject(Request $request, $projectId)
    {
        $projects = Project::all();
        $project = Project::findOrFail($projectId);
        $categories = Category::all();
        $statuses = Status::all();

        $tasks = Task::with(['project', 'comments', 'user', 'category', 'status'])
            ->where('project_id', $projectId)
            ->get()
            ->groupBy('category_id');

        return view('cpanel.tasks.projectTasks', [
            'tasks' => $tasks,
            'projects' => $projects,
            'project' => $project,
            'categories' => $categories,
            'statuses' => $statuses,
            'selectedProjectId' => $projectId,
        ]);
    }

    public function taskReport()
    {
        $projectNames = Project::select('name')->distinct()->pluck('name');
        $statuses = Task::with('status')->get()->pluck('status.name')->unique();
        $priorities = Task::select('priority')->distinct()->pluck('priority')->unique();
        $categories = Task::with('category')->get()->pluck('category.name')->unique();
        $createdBys = Task::with('user')->get()->pluck('user.name')->unique();

        return view('cpanel.reports.Tasks.index', compact('projectNames', 'statuses', 'priorities', 'categories', 'createdBys'));
    }


    public function taskPdf(Request $request)
    {
        try {
            $query = Task::query();

            if ($request->filled('project_name')) {
                $query->whereHas('project', function ($q) use ($request) {
                    $q->where('name', $request->input('project_name'));
                });
            }
            if ($request->filled('status')) {
                $query->whereHas('status', function ($q) use ($request) {
                    $q->where('name', $request->input('status'));
                });
            }
            if ($request->filled('start_date')) {
                $query->where('due_date', $request->input('start_date'));
            }
            if ($request->filled('completed_at')) {
                $query->whereDate('completed_at', $request->input('completed_at')); // استخدام whereDate لمقارنة فقط التاريخ
            }
            if ($request->filled('priority')) {
                $query->where('priority', $request->input('priority'));
            }
            if ($request->filled('category_id')) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('name', $request->input('category_id'));
                });
            }
            if ($request->filled('from_date')) {
                $query->whereDate('created_at', '>=', $request->input('from_date'));
            }
            if ($request->filled('to_date')) {
                $query->whereDate('created_at', '<=', $request->input('to_date'));
            }

            if ($request->filled('created_by')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', $request->input('created_by'));
                });
            }

            $tasks = $query->get();
            if ($tasks->isEmpty()) {
                return redirect()->back()->withErrors(['msg' => __('filters no match')]);
            }

            $data = [
                'tasks' => $tasks,
                'title' => $request->input('title', __('Task Report')),
                'content' => $tasks->count(),
            ];

            $pdf = Pdf::loadView('cpanel.reports.tasks.pdf.taskReport', $data)->setPaper('a4', 'landscape');
            return $pdf->download('task_report.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }


}
