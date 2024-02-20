<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\ImportPlayerController;
use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\MenuController;
use App\Http\Controllers\Panel\RoleController;

//Route::post('import-player', [ImportPlayerController::class, 'import']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('auth', [AuthController::class, 'auth']);
    Route::get('menu', [AuthController::class, 'menu']);

    Route::resource('users', UserController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('roles', RoleController::class);

    Route::get('roles-list', [RoleController::class, 'list']);
    Route::get('menu-role', [MenuController::class, 'menuRole']);
    Route::get('menus-list', [MenuController::class, 'list']);
});
