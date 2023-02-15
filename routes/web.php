<?php

use Illuminate\Support\Facades\Route;

use app\Http\Controllers\Front\HomeController;

Route::get('/',[HomeController::class, 'index']);
