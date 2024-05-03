<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Edis SuperAdmin', 
            'email' => 'superadmin@notus.com',
            'password' => Hash::make('password')
        ]);
        $superAdmin->assignRole('Super Admin');

        $admin = User::create([
            'name' => 'Edis Admin', 
            'email' => 'admin@notus.com',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole('Admin');

        
        $moderator = User::create([
            'name' => 'Edis Moderator', 
            'email' => 'moderator@notus.com',
            'password' => Hash::make('password')
        ]);
        $moderator->assignRole('Moderator');
    }
}
