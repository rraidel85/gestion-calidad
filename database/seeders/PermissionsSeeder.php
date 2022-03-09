<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list files']);
        Permission::create(['name' => 'view files']);
        Permission::create(['name' => 'create files']);
        Permission::create(['name' => 'update files']);
        Permission::create(['name' => 'delete files']);

        // Create 'Usuario General' role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'Usuario General']);
        $userRole->givePermissionTo($currentPermissions);


        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create 'Jefe de Área' role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'Jefe de Área']);
        $userRole->givePermissionTo($currentPermissions);


        // Create admin exclusive permissions
        Permission::create(['name' => 'list areas']);
        Permission::create(['name' => 'view areas']);
        Permission::create(['name' => 'create areas']);
        Permission::create(['name' => 'update areas']);
        Permission::create(['name' => 'delete areas']);

        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);
        
        Permission::create(['name' => 'list typeareas']);
        Permission::create(['name' => 'view typeareas']);
        Permission::create(['name' => 'create typeareas']);
        Permission::create(['name' => 'update typeareas']);
        Permission::create(['name' => 'delete typeareas']);

        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'Administrador']);
        $adminRole->givePermissionTo($allPermissions);

        $user = User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
