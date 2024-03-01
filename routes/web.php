<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', UserController::class);
Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout']);

Route::get('timeline', [GaleryController::class, 'index']);
Route::post('uploadfoto', [GaleryController::class, 'upload']);
Route::post('editfoto/{id}', [GaleryController::class, 'editfoto']);
Route::get('hapusfoto/{id}', [GaleryController::class, 'hapusfoto']);


Route::resource('admin', AdminController::class)->middleware('auth');
Route::get('status/{id}', [AdminController::class, 'destroy'])->middleware('auth');
Route::get('accimage', [AdminController::class, 'accImage'])->middleware('auth');
