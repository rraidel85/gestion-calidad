<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TypeAreaController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AreaFilesController;
use App\Http\Controllers\Api\AreaUsersController;
use App\Http\Controllers\Api\UserFilesController;
use App\Http\Controllers\Api\UserAreasController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\TypeAreaAreasController;
use App\Http\Controllers\Api\CategoryFilesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('type-areas', TypeAreaController::class);

        // TypeArea Areas
        Route::get('/type-areas/{typeArea}/areas', [
            TypeAreaAreasController::class,
            'index',
        ])->name('type-areas.areas.index');
        Route::post('/type-areas/{typeArea}/areas', [
            TypeAreaAreasController::class,
            'store',
        ])->name('type-areas.areas.store');

        Route::apiResource('areas', AreaController::class);

        // Area Files
        Route::get('/areas/{area}/files', [
            AreaFilesController::class,
            'index',
        ])->name('areas.files.index');
        Route::post('/areas/{area}/files', [
            AreaFilesController::class,
            'store',
        ])->name('areas.files.store');

        // Area Users
        Route::get('/areas/{area}/users', [
            AreaUsersController::class,
            'index',
        ])->name('areas.users.index');
        Route::post('/areas/{area}/users/{user}', [
            AreaUsersController::class,
            'store',
        ])->name('areas.users.store');
        Route::delete('/areas/{area}/users/{user}', [
            AreaUsersController::class,
            'destroy',
        ])->name('areas.users.destroy');

        Route::apiResource('files', FileController::class);

        Route::apiResource('categories', CategoryController::class);

        // Category Files
        Route::get('/categories/{category}/files', [
            CategoryFilesController::class,
            'index',
        ])->name('categories.files.index');
        Route::post('/categories/{category}/files', [
            CategoryFilesController::class,
            'store',
        ])->name('categories.files.store');

        Route::apiResource('users', UserController::class);

        // User Files
        Route::get('/users/{user}/files', [
            UserFilesController::class,
            'index',
        ])->name('users.files.index');
        Route::post('/users/{user}/files', [
            UserFilesController::class,
            'store',
        ])->name('users.files.store');

        // User Areas
        Route::get('/users/{user}/areas', [
            UserAreasController::class,
            'index',
        ])->name('users.areas.index');
        Route::post('/users/{user}/areas/{area}', [
            UserAreasController::class,
            'store',
        ])->name('users.areas.store');
        Route::delete('/users/{user}/areas/{area}', [
            UserAreasController::class,
            'destroy',
        ])->name('users.areas.destroy');
    });
