<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\ImportPlayerController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('import-player', [ImportPlayerController::class, 'import']);
Route::get('test', [ImportPlayerController::class, 'test']);
