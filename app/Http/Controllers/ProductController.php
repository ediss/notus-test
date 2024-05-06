<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Events\ProductDeleted;
use Illuminate\Contracts\View\View;
use App\Http\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use App\Http\Services\CategoryService;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-product|edit-product|delete-product');
    }


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
    public function store(StoreProductRequest $request, ProductService $service): RedirectResponse
    {
        $data = $request->validated();

        $service->createProduct(
            $data,
            $request->file('main_image'),
            $request->file('additional_images') ?? []
        );

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
    public function destroy(Product $product): RedirectResponse
    {

        event(new ProductDeleted($product));

        $product->delete();

        return redirect()->route('products.index')
                ->withSuccess('Prodcut is deleted successfully.');
    }
}
