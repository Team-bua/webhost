<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LoginController;
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

//Sign In
Route::group(['middleware' => 'user'], function () {
    Route::get('/data',[AdminController::class,'viewAdmin'])->name('data');
    //Admin
    Route::get('/users',[AdminController::class,'viewUsers'])->name('users');

});
Route::get('/',[LoginController::class,'viewSign'])->name('signin.view');
Route::post('/sigin-in',[LoginController::class,'postSignIn'])->name('signin');
//Logout
Route::get('/logout',[LoginController::class,'postLogout'])->name('logout');
