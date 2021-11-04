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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
