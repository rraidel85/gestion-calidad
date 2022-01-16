<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TypeAreaController;
use App\Http\Controllers\Api\AreaUsersController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\TypeAreaAreasController;

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

        Route::apiResource('users', UserController::class);

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

        // Area Users
        Route::get('/areas/{area}/users', [
            AreaUsersController::class,
            'index',
        ])->name('areas.users.index');
        Route::post('/areas/{area}/users', [
            AreaUsersController::class,
            'store',
        ])->name('areas.users.store');
    });
