<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'comment' => 'required|string|max:255',
//        ]);
        try {
            $this->authorize('create', Comment::class);
            Comment::create([
                'comment' => $request->comment,
                'task_id' => $request->task_id,
                'created_by' => $request->user()->id,
            ]);
            return redirect()->back()->with('success', 'Comment added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Comment::class);
        $comment = Comment::findOrFail($id);
        try {
            $comment->update($request->only('comment'));
            return redirect()->back()->with('success', 'Comment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', Comment::class);
        $comment = Comment::findOrFail($id);

        try {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
