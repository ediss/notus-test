<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Services\CategoryService;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('products.index', [
            'products' => Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryService $service) : View
    {
        return view('products.create', [
            'categories' => $service->getCategories()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        // Store the main image
        $mainImage = $request->file('main_image');
        $mainImagePath = $mainImage->store('public/products');

        // Store the additional images
        $additionalImagePaths = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $additionalImage) {
                $additionalImagePath = $additionalImage->store('public/products');
                $additionalImagePaths[] = $additionalImagePath;
            }
        }

    
        $data = $request->all();
        $data['main_image'] = str_replace('public/', 'storage/', $mainImagePath);

    
        $product = Product::create($data);


        // Attach categories
        $product->categories()->attach($request->categories);

        // Save additional image paths in database
        foreach ($additionalImagePaths as $imagePath) {
            $product->images()->create([
                'path' => str_replace('public/', 'storage/', $imagePath)
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
