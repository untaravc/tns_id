<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\ImportPlayerController;
use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\MenuController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\PlayerController;
use App\Http\Controllers\Panel\CompetitionController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\PointController;
use App\Http\Controllers\Panel\MatchController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\SettingController;

//Route::post('import-player', [ImportPlayerController::class, 'import']);
Route::post('login', [AuthController::class, 'login']);
Route::post('upload', [DashboardController::class, 'upload']);
Route::post('test', [DashboardController::class, 'test']);

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
    Route::resource('posts', PostController::class);
    Route::resource('settings', SettingController::class);

    Route::get('point-reports', [PointController::class, 'pointReports']);
    Route::get('roles-list', [RoleController::class, 'list']);
    Route::get('menu-role', [MenuController::class, 'menuRole']);
    Route::get('menus-list', [MenuController::class, 'list']);
    Route::get('players-list', [PlayerController::class, 'list']);
    Route::get('competitions-list', [CompetitionController::class, 'list']);
    Route::get('categories-list', [CategoryController::class, 'list']);
    Route::get('dashboard-stats', [DashboardController::class, 'dashboardStats']);
    Route::get('import-players', [ImportPlayerController::class, 'import']);
    Route::get('match-points', [PostController::class, 'playerMatchPoint']);
    Route::get('match-points/{id}', [PostController::class, 'matchPoint']);

    Route::patch('menu-role', [MenuController::class, 'menuRoleUpdate']);
});

Route::get('/update-player-category', [PlayerController::class, 'updatePlayerCategory']);
Route::get('/update-player-points', [PointController::class, 'updatePlayerPoints']);
Route::get('/update-competition-status', [CompetitionController::class, 'updateStatus']);
Route::get('/head-to-head/{match_id}', [MatchController::class, 'searchH2H']);
