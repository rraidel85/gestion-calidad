<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeAreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FileController::class, 'index']);

Auth::routes();

// Disabling register route
Route::get('/register', function(){ return abort(404);});

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('files', FileController::class);
Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('type-areas', TypeAreaController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
    });


Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');

Route::get('/area_select', [TypeAreaController::class, 'area_select'])->name('area_select');



//---------Test Area------------ 

// use App\Models\Area;
// use App\Models\User;
// use App\Models\TypeArea;
// use App\Models\File;
// use App\Models\Category;
// use Barryvdh\Debugbar\Facades\Debugbar;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\DB;

// Route::get('/test', function(){
//     //Route made just for testing database queries 

//     $categoriesToFilter = [7,5,2];

//     //Returns each file that has associated all the categories listed by parameters
//     $eloquent = File::whereHas('categories', function (Builder $query) use($categoriesToFilter){
//         $query->whereIn('categories.id',$categoriesToFilter)
//         ->groupBy('file_id')
//         ->havingRaw('COUNT(category_id) = ?', [count($categoriesToFilter)]);
//     })->get()->toArray();
    
//     Debugbar::info($eloquent);
//     // $q_builder = DB::table('areas')->get();
//     // Debugbar::info($q_builder);
    
//     return view('welcome');
// });