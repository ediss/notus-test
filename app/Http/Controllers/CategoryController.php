<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with([
            'children.children',
             'parent'
        ])->paginate(10);  

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create', [
            'parents' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        
        Category::create($request->all());

        return redirect()->route('categories.index')
                ->withSuccess('Category is created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
            'parents' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update($request->all());

        return redirect()->back()
                ->withSuccess('Category is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
                ->withSuccess('Category is deleted successfully.');
    }
}
