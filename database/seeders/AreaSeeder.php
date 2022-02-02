<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'name' => 'Area de Administración',
            'description' => 'Esta es el area del administrador del sistema',
            'type_area_id' => 1,
        ]);
        Area::create([
            'name' => 'General',
            'description' => 'Esta es el area general, la que se usa por defecto',
            'type_area_id' => 1,
        ]);

        Area::factory()
            ->count(20)
            ->create();
    }
}
