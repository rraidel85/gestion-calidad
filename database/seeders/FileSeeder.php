<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        File::factory()
            ->count(25)
            ->create();

        foreach (File::all() as $file) {
            $file->area_id = $file->user->area->id;
            $file->save();
        }
    }
}
