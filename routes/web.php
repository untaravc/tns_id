<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Front\HomeController;
use \App\Http\Controllers\Panel\DashboardController;

Route::get('/',[HomeController::class, 'index']);
Route::get('/players',[HomeController::class, 'players']);
Route::get('/players/{id}',[HomeController::class, 'player_show']);
Route::get('/events',[HomeController::class, 'events']);
Route::get('/matches',[HomeController::class, 'matches']);
Route::get('/news',[HomeController::class, 'news']);

Route::get('/panel',[DashboardController::class, 'dashboard']);
Route::get('/panel/{path}', [DashboardController::class,'dashboard'])
    ->where( 'path' , '([A-z\d\-\/_.]+)?' );
