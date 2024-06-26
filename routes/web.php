<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\MatchController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/players', [HomeController::class, 'players']);
Route::get('/players/{id}', [HomeController::class, 'player_show']);
Route::get('/competitions', [HomeController::class, 'competitions']);
Route::get('/competitions/{id}', [HomeController::class, 'competitionsShow']);
Route::get('/matches', [MatchController::class, 'index']);
Route::get('/matches/{player_id}', [MatchController::class, 'matchPlayer']);
Route::get('/news', [HomeController::class, 'news']);
Route::get('/posts/{id}', [HomeController::class, 'postShow']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy']);

Route::get('/icons', [HomeController::class, 'icons']);

Route::get('/auth/404', [HomeController::class, 'notFound']);
Route::get('/auth', [HomeController::class, 'auth']);

Route::get('/auth/{path}', [HomeController::class, 'auth'])
    ->where('path', '([A-z\d\-\/_.]+)?');

Route::get('/admin', [HomeController::class, 'admin']);
Route::get('/admin/{path}', [HomeController::class, 'admin'])
    ->where('path', '([A-z\d\-\/_.]+)?');


