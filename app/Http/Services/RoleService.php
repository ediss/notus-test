<?php

namespace App\Http\Services;

use Spatie\Permission\Models\Role;

class RoleService {
    
    public function getRoles() {
        return Role::whereNotIn('name', ['Super Admin'])->pluck('name')->all();
    }
}