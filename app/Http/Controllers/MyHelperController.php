<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\TypeArea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MyHelperController extends Controller
{
    public function area_select()
    {
        $type_areas = TypeArea::with('areas')->get();
        
        return view('app.others.area_select', compact('type_areas'));
    }

    public function files_category_api(Request $request)
    {
        dd($request);
        $files = File::whereHas('categories', function (Builder $query) use($categoriesToFilter){
                    $query->whereIn('categories.id',$categoriesToFilter)
                    ->groupBy('file_id')
                    ->havingRaw('COUNT(category_id) = ?', [count($categoriesToFilter)]);
                })->get();
        
    }
}
