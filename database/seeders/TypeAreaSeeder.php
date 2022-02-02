<?php

namespace Database\Seeders;

use App\Models\TypeArea;
use Illuminate\Database\Seeder;

class TypeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeArea::create([
            'name' => 'Administracion'
        ]);

        TypeArea::factory()
            ->count(5)
            ->create();
    }
}
