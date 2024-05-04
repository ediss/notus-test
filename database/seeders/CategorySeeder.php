<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Clothes']);
        Category::create(['name' => 'Shoes']);
        Category::create([
            'name' => 'Snekaers',
            'parent_id' => 2
        ]);

        Category::create([
            'name' => 'Boots',
            'parent_id' => 2
        ]);

        Category::create([
            'name' => 'T-shirt',
            'parent_id' => 1
        ]);

        Category::create([
            'name' => 'Polo',
            'parent_id' => 5
        ]);

    }
}
