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
        // $categories = Category::all()->shuffle();    
        // $files = File::pluck('id')->shuffle()->all();//reordering and converting collection to array
        
        
        // $files_copia = $files;

        // for ($i = 0; $i < $categories->count(); $i++) {
        //     for ($j = 0; $j < 3; $j++) {
        //         $categories[$i]->files()->attach(array_pop($files_copia));  
        //    }  
        //    $files_copia = $files;
        // }

        
        $files = File::all()->shuffle();    
        $categories = Category::pluck('id')->shuffle()->all();//reordering and converting collection to array
        
        
        $categories_copia = $categories;

        for ($i = 0; $i < $files->count(); $i++) {
            for ($j = 0; $j < 3; $j++) {
                $files[$i]->categories()->attach(array_pop($categories_copia));  
           }  
           $categories_copia = Category::pluck('id')->shuffle()->all();
        }
    }
}
