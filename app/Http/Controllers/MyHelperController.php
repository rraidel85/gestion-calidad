<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\File;
use App\Models\TypeArea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

// use Barryvdh\Debugbar\Facades\Debugbar;

class MyHelperController extends Controller
{
    public function area_select()
    {
        $type_areas = TypeArea::with('areas')->get();
        
        return view('app.others.area_select', compact('type_areas'));
    }

    public function my_files()
    {
        $this->authorize('create', File::class);

        $loggedUserId = auth()->user()->id;

        $categories = Category::all();
        $files = File::where('user_id', $loggedUserId)->get();

        return view('app.files.index', compact('files','categories'));
    }

    public function my_area_files()
    {
        $this->authorize('create', File::class);

        $loggedUserAreaId = auth()->user()->area_id;

        $categories = Category::all();
        $files = File::where('area_id', $loggedUserAreaId)->get();

        return view('app.files.index', compact('files','categories'));
    }


    public function calidad_files(){
        $this->authorize('create', File::class);

        $calidad_id = Area::where('name', 'like', 'Departamento de Calidad')
                    ->first();
        if($calidad_id){
            $calidad_id = $calidad_id->id;
        }
        $categories = Category::all();
        $files = File::where('area_id', $calidad_id)->get();

        return view('app.files.index', compact('files','categories'));
    }


    public function files_category_api(Request $request)
    {   
        $categoriesToFilter = request()->selectedCategories;
        $routeAction = request()->routeAction;
        
        $myResponseArray = [];
        $hasPermission = false;

        $fileQuery = File::whereHas('categories', function (Builder $query) use($categoriesToFilter){
            $query->whereIn('categories.id',$categoriesToFilter)
            ->groupBy('file_id')
            ->havingRaw('COUNT(category_id) = ?', [count($categoriesToFilter)]);
        })->with(['area:id,name', 'user:id,name']);


        if($routeAction == "App\Http\Controllers\FileController@index"){

            if (!empty($categoriesToFilter)){
                $files = $fileQuery->get();
            }
            else{
                $files = File::with(['area:id,name', 'user:id,name'])->get();
            }
        }
        elseif($routeAction == "App\Http\Controllers\MyHelperController@my_files"){
            
            if (!empty($categoriesToFilter) && $request->user()){
                $files = $fileQuery->where('user_id', $request->user()->id)->get();
            }
            else{
                $files = File::with(['area:id,name', 'user:id,name'])
                ->where('user_id', $request->user()->id)->get();
            }
         }   
        elseif($routeAction == "App\Http\Controllers\MyHelperController@my_area_files"){ 

            if (!empty($categoriesToFilter) && $request->user()){
                $files = $fileQuery->where('area_id', $request->user()->area_id)->get();
            }
            else{
                $files = File::with(['area:id,name', 'user:id,name'])
                ->where('area_id', $request->user()->area_id)->get();
            }
        }
        elseif($routeAction == "App\Http\Controllers\FileController@files_by_area"){

            $dividedUrl = explode('/', url()->previous());
            $area_id = intval(end($dividedUrl)); //Get the area id from url

            if (!empty($categoriesToFilter)){
                $files = $fileQuery->where('area_id', $area_id)->get();
            }
            else{
                $files = File::with(['area:id,name', 'user:id,name'])
                ->where('area_id', $area_id)->get();
            }
        }
        
        foreach ($files as $file) {
            if($request->user()){
                $hasPermission = $request->user()->can('update', $file);   
            }else{
                $hasPermission = false;
            }
            $myResponseArray[] = ['file' => $file, 'hasPermission' => $hasPermission];
        }
        
        return response()->json($myResponseArray);
    }

}
