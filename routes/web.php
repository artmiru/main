<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\MkController;
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

//Route::get('mk2', function () {
//    return view('mk.list');
//});
Route::get('mk',[MkController::class,'index']);
Route::get('/',[MkController::class,'index']);

//админ
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('art',[App\Http\Controllers\Admin\AdminController::class,'index']);
Route::get('art/mk',[App\Http\Controllers\Admin\AdminController::class,'MkList']);
Route::get('art/profile/{id}',[App\Http\Controllers\Admin\AdminController::class,'profile']);
Route::get('dbupdate',[\App\Http\Controllers\DbUpdateController::class,'index']);
