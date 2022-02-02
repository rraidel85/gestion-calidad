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

Route::get('/', [FileController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('type-areas', TypeAreaController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('files', FileController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
    });


Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');

Route::get('/area_select', [TypeAreaController::class, 'area_select'])->name('area_select');