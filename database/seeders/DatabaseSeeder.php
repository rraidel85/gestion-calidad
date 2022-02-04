<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            TypeAreaSeeder::class,
            AreaSeeder::class,
            UserSeeder::class,
            PermissionsSeeder::class,
            UserRoleSeeder::class,
            CategorySeeder::class,
            FileSeeder::class,
            CategoryFileSeeder::class,
        ]);
    }
}
