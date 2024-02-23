<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\ImportPlayerController;
use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\MenuController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\PlayerController;
use App\Http\Controllers\Panel\CompetitionController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\PointController;
use App\Http\Controllers\Panel\MatchController;

//Route::post('import-player', [ImportPlayerController::class, 'import']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('auth', [AuthController::class, 'auth']);
    Route::get('menu', [AuthController::class, 'menu']);

    Route::resource('users', UserController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('players', PlayerController::class);
    Route::resource('competitions', CompetitionController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('points', PointController::class);
    Route::resource('matches', MatchController::class);

    Route::get('point-reports', [PointController::class, 'pointReports']);
    Route::get('roles-list', [RoleController::class, 'list']);
    Route::get('menu-role', [MenuController::class, 'menuRole']);
    Route::get('menus-list', [MenuController::class, 'list']);
    Route::get('players-list', [PlayerController::class, 'list']);
    Route::get('competitions-list', [CompetitionController::class, 'list']);
    Route::get('categories-list', [CategoryController::class, 'list']);

    Route::get('import-players', [ImportPlayerController::class, 'import']);
});
