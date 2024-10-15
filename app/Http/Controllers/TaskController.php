<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Comment;
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
        if ($request->has('project_id')) {
            $tasks = Task::where('project_id', $request->project_id)
                ->with(['project', 'comments', 'attachments', 'user', 'category', 'status'])
                ->get();
        } else {
            $tasks = Task::with(['project', 'comments', 'attachments', 'user', 'category', 'status'])
                ->get();
        }

        foreach ($tasks as $task) {
//            dd($task->attachments->first());
            if ($task->attachments->isNotEmpty()) {
                // احصل على أول صورة من المرفقات
                $task->first_image_attachment = $task->attachments->first(function ($attachment) {
                    return preg_match('/\.(jpg|jpeg|png|gif)$/i', $attachment->file_path);
                });
            } else {
                $task->first_image_attachment = null; // تعيين null إذا لم تكن هناك مرفقات
            }
        }
        return view('cpanel.tasks.index', [
            'tasks' => $tasks,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
