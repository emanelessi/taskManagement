<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Category::class);
        $query = $request->input('search');
        $categories = Category::where('name', 'like', "%$query%")
            ->orWhere('status', 'like', "%$query%")
            ->paginate(10);

        return view('cpanel.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|string|in:enable,disable',
        ], [
            'name.unique' => 'The category name already exists. Please choose another name.',
        ]);

        try {
            // Create a new category
            Category::create($request->only(['name', 'status']));
            return redirect()->route('categories')->with('success', 'Category added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'status' => 'required|string|in:enable,disable',
        ]);

        try {
            // Update the category
            $category->update($request->only(['name', 'status']));
            return redirect()->route('categories')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('delete', $category);
        try {
            $category->delete();
            return redirect()->route('categories')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
