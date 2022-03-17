<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\File;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoryFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // $files = File::all()->shuffle();  //Get all files and reorder them  
        // $categories = Category::pluck('id')->shuffle()->all();//Reordering and converting category collection to array
        
        
        // $categories_copia = $categories;

        // //For all files attach 3 random categories to each of them
        // for ($i = 0; $i < $files->count(); $i++) {
        //     for ($j = 0; $j < 3; $j++) {
        //         $files[$i]->categories()->attach(array_pop($categories_copia));  
        //    }  
        //    $categories_copia = Category::pluck('id')->shuffle()->all();
        // }
    }
}
