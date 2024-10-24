<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'update']);

        $admin = Role::create(['name' => 'project manager']);
        $admin->givePermissionTo(['create', 'read', 'update']);

        $developer = Role::create(['name' => 'developer']);
        $developer->givePermissionTo(['read', 'update']);

    }
}
