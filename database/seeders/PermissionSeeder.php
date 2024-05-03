<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-category',
            'edit-category',
            'delete-category',
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product',
            'create-comment',
            'edit-comment',
            'delete-comment'
         ];
 
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
