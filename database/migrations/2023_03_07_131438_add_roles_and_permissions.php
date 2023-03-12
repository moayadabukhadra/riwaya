<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Permission::create([
            'name' => 'create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'read',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'update',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'delete',
            'guard_name' => 'api'
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ])->givePermissionTo('create', 'read', 'update', 'delete');
        Role::create([
            'name' => 'content_manager',
            'guard_name' => 'api'
        ])->givePermissionTo('create', 'read', 'update', 'delete');
        Role::create([
            'name' => 'content_creator',
            'guard_name' => 'api'
        ])->givePermissionTo('create', 'read', 'update', 'delete');
        Role::create([
            'name' => 'user',
            'guard_name' => 'api'
        ])->givePermissionTo('read');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       //
    }
};
