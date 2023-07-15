<?php

use App\Http\Controllers\GenerateImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 生成用ルーティング
Route::prefix('generate')->group(function () {
    Route::name('generate.')->group(function () {
        Route::get('image', [GenerateImageController::class, 'index'])->name('image.index');
        Route::post('image/download', [GenerateImageController::class, 'downloadImage'])->name('image.download');
    });
});
