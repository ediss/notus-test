<?php

namespace App\Http\Services;

use App\Models\Product;

class ProductService
{
    public function createProduct($data, $mainImage, $additionalImages)
    {
        $mainImagePath = $this->storeImage($mainImage);
        $additionalImagePaths = $this->storeAdditionalImages($additionalImages);

        $data['main_image'] = $this->formatImagePath($mainImagePath);

        $product = Product::create($data);
        $product->categories()->attach($data['categories']);

        foreach ($additionalImagePaths as $imagePath) {
            $product->images()->create([
                'path' => $this->formatImagePath($imagePath)
            ]);
        }

        return $product;
    }

    protected function storeImage($image)
    {
        return $image->store('public/products');
    }

    protected function storeAdditionalImages($additionalImages)
    {
        $additionalImagePaths = [];

        foreach ($additionalImages as $additionalImage) {
            $additionalImagePaths[] = $this->storeImage($additionalImage);
        }

        return $additionalImagePaths;
    }

    protected function formatImagePath($path)
    {
        return str_replace('public/', 'storage/', $path);
    }
}
