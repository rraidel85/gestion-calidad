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
        Permission::create(['name' => 'listar documentos']);
        Permission::create(['name' => 'ver documentos']);
        Permission::create(['name' => 'crear documentos']);
        Permission::create(['name' => 'editar documentos']);
        Permission::create(['name' => 'eliminar documentos']);

        // Create 'Usuario General' role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'Usuario General']);
        $userRole->givePermissionTo($currentPermissions);


        Permission::create(['name' => 'listar usuarios']);
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);

        // Create 'Jefe de Área' role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'Jefe de Área']);
        $userRole->givePermissionTo($currentPermissions);


        // Create admin exclusive permissions
        Permission::create(['name' => 'listar áreas']);
        Permission::create(['name' => 'ver áreas']);
        Permission::create(['name' => 'crear áreas']);
        Permission::create(['name' => 'editar áreas']);
        Permission::create(['name' => 'eliminar áreas']);

        Permission::create(['name' => 'listar categorías']);
        Permission::create(['name' => 'ver categorías']);
        Permission::create(['name' => 'crear categorías']);
        Permission::create(['name' => 'editar categorías']);
        Permission::create(['name' => 'eliminar categorías']);
        
        Permission::create(['name' => 'listar tipos de área']);
        Permission::create(['name' => 'ver tipos de área']);
        Permission::create(['name' => 'crear tipos de área']);
        Permission::create(['name' => 'editar tipos de área']);
        Permission::create(['name' => 'eliminar tipos de área']);

        Permission::create(['name' => 'listar roles']);
        Permission::create(['name' => 'ver roles']);
        Permission::create(['name' => 'crear roles']);
        Permission::create(['name' => 'editar roles']);
        Permission::create(['name' => 'eliminar roles']);

        Permission::create(['name' => 'listar permisos']);
        Permission::create(['name' => 'ver permisos']);
        Permission::create(['name' => 'crear permisos']);
        Permission::create(['name' => 'editar permisos']);
        Permission::create(['name' => 'eliminar permisos']);

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
