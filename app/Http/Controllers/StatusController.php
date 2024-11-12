<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Status::class);
        $query = $request->input('search');
        $statuses = Status::where('name', 'like', "%$query%")
            ->orWhere('status', 'like', "%$query%")
            ->paginate(10);

        return view('cpanel.status.index', ['statuses' => $statuses]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Status::class);
        $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name',
            'status' => 'required|string|in:enable,disable',
        ], [
            'name.unique' => 'The Status name already exists. Please choose another name.',
        ]);

        try {
            Status::create($request->only(['name', 'status']));
            return redirect()->back()->with('success', 'Status added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        $this->authorize('update', $status);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name,' . $status->id,
            'status' => 'required|string|in:enable,disable',
        ]);

        try {
            $status->update($request->only(['name', 'status']));
            return redirect()->back()->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $this->authorize('delete', $status);
        try {
            $status->delete();
            return redirect()->route('status')->with('success', 'Status deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
