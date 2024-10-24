<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
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
        $tasks = $tasksQuery->paginate(6);
        foreach ($tasks as $task) {
            $task->first_image_attachment = $task->attachments->isNotEmpty()
                ? $task->attachments->first(function ($attachment) {
                    return preg_match('/\.(jpg|jpeg|png|gif)$/i', $attachment->file_path);
                })
                : null;
        }
        return view('cpanel.tasks.index', [
            'tasks' => $tasks,
            'projects' => $projects,
            'categories' => $categories,
            'statuses' => $statuses,
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
            return redirect()->route('tasks')->with('success', 'Task added successfully!');
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
            return redirect()->route('tasks')->with('success', 'Tasks updated successfully!');
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
//        dd('Reached');
        $projects = Project::findOrFail($projectId);
        $categories = Category::all();
        $statuses = Status::all();
//dd($projects);
        $tasks = Task::with(['project', 'comments', 'attachments', 'user', 'category', 'status'])
            ->where('project_id', $projectId)
            ->get()
            ->groupBy('category_id');

        foreach ($tasks as $taskGroup) {
            foreach ($taskGroup as $task) {
                if ($task->attachments->isNotEmpty()) {
                    $task->first_image_attachment = $task->attachments->first(function ($attachment) {
                        return preg_match('/\.(jpg|jpeg|png|gif)$/i', $attachment->file_path);
                    });
                } else {
                    $task->first_image_attachment = null;
                }
            }
        }

        return view('cpanel.tasks.projectTasks', [
            'tasks' => $tasks,
            'projects' => $projects,
            'categories' => $categories,
            'statuses' => $statuses,
            'selectedProjectId' => $projectId,
        ]);
    }


}
