<?php

namespace App\Http\Controllers;

use App\Models\TypeArea;
use Illuminate\Http\Request;

class MyHelperController extends Controller
{
    public function area_select()
    {
        $type_areas = TypeArea::with('areas')->get();
        
        return view('app.others.area_select', compact('type_areas'));
    }
}
