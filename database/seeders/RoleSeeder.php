<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $moderator = Role::create(['name' => 'Moderator']);

        $admin->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product',

            'create-comment',
            'edit-comment',
            'delete-comment',
            'approve-comment',

            'create-category',
            'edit-category',
            'delete-category'
        ]);

        $moderator->givePermissionTo([
            'create-comment',
            'edit-comment',
            'delete-comment',
            'approve-comment',
        ]);
    }
}
