<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //Assign to each user except Admin a role between 'Usuario General' and 'Jefe de Área'
        // User::where('email','!=','admin@admin.com')->each(function ($user, $key) {
        //     $user->assignRole(rand(1, 2));
        // });
    }
}
