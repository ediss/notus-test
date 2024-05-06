<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Services\CategoryService;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-category|edit-category|delete-category');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
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
    public function create(CategoryService $service): View
    {
        return view('categories.create', [
            'parents' => $service->getCategories()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        
        Category::create($request->all());

        return redirect()->route('categories.index')
                ->withSuccess('Category is created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, CategoryService $service): View
    {
        return view('categories.edit', [
            'category' => $category,
            'parents' => $service->getCategories()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {

        $category->update($request->all());

        return redirect()->back()
                ->withSuccess('Category is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')
                ->withSuccess('Category is deleted successfully.');
    }
}
