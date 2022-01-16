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
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AreaSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(FileSeeder::class);
        $this->call(TypeAreaSeeder::class);
        $this->call(UserSeeder::class);
    }
}
