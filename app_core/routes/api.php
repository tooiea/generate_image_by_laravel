<?php

use App\Http\Controllers\Api\GenerateImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 生成用ルーティング
Route::prefix('generate')->group(function () {
    Route::name('generate.')->group(function () {
        Route::get('image', [GenerateImageController::class, 'index'])->name('image.index');
        Route::get('image/download', [GenerateImageController::class, 'downloadImage'])->name('image.download');
    });
});