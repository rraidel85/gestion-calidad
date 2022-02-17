<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeAreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyHelperController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

Route::resource('/files', FileController::class);

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        // Route::resource('roles', RoleController::class);
        // Route::resource('permissions', PermissionController::class);

        Route::resource('type-areas', TypeAreaController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
        Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('my_files', [MyHelperController::class, 'my_files'])->name('my_files');
        Route::get('my_area_files', [MyHelperController::class, 'my_area_files'])->name('my_area_files');
    });


Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');
Route::get('/files/files_by_area/{id}', [FileController::class, 'files_by_area'])->name('files.files_by_area');


Route::get('/area_select', [MyHelperController::class, 'area_select'])->name('area_select');
Route::post('/files_category_api', [MyHelperController::class, 'files_category_api'])->name('files_category_api');





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

//     $categoriesToFilter = [3];

//     //Returns each file that has associated all the categories listed by parameters
//     $eloquent = File::whereHas('categories', function (Builder $query) use($categoriesToFilter){
//         $query->whereIn('categories.id',$categoriesToFilter)
//         ->groupBy('file_id')
//         ->havingRaw('COUNT(category_id) = ?', [count($categoriesToFilter)]);
//     })->with(['area:id,name', 'user:id,name'])->where('user_id',3)->get();
    
//     Debugbar::info($eloquent);
//     // $q_builder = DB::table('areas')->get();
//     // Debugbar::info($q_builder);
    
//     return view('welcome');
// });