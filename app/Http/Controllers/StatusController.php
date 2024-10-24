<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::paginate(6);
        return view('cpanel.status.index', ['statuses' => $statuses]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name',
            'status' => 'required|string|in:enable,disable',
        ], [
            'name.unique' => 'The Status name already exists. Please choose another name.',
        ]);

        try {
            Status::create($request->only(['name', 'status']));
            return redirect()->route('status')->with('success', 'Status added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name,' . $status->id,
            'status' => 'required|string|in:enable,disable',
        ]);

        try {
            $status->update($request->only(['name', 'status']));
            return redirect()->route('status')->with('success', 'Status updated successfully!');
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
            $status = Status::findOrFail($id);
            $status->delete();
            return redirect()->route('status')->with('success', 'Status deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
