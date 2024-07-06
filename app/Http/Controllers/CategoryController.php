<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id')->paginate(2);
        return view('dashboard.categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required',
        ], [
            'categoryName.required' => 'Category name is required.',
        ]);
        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->save();
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categoryName' => 'required',
        ], [
            'categoryName.required' => 'Category name is required.',
        ]);
        $category->categoryName = $request->categoryName;
        $category->save();
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Category $category)
        {
            $category->delete();
            return redirect()->route('categories.index')
                ->with('success','Category deleted successfully');

        }
}
