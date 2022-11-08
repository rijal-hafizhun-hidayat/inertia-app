<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('home.index');
Route::get('/create', [\App\Http\Controllers\ProfileController::class, 'create'])->name('home.create');

//resource
Route::post('/post', [\App\Http\Controllers\ProfileController::class, 'store'])->name('home.store');
Route::delete('/post/{id}', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('home.destroy');
Route::get('/post/{id}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('home.show');
Route::put('/post/{id}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('home.update');

// Route::get('/', function () {
//     return view('welcome');
// });
