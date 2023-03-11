<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Front\HomeController;

Route::get('/',[HomeController::class, 'index']);
Route::get('/players',[HomeController::class, 'players']);
Route::get('/players/{id}',[HomeController::class, 'player_show']);
