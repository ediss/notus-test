<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService {
    
    public function getCategories() {
        return Category::all();
    }
}