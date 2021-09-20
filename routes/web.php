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
    Route::post('/add-user',[AdminController::class,'createUser'])->name('adduser');
    Route::get('/delete-user',[AdminController::class,'delete'])->name('users.delete');

    Route::get('/profile/{id}',[AdminController::class,'getProfile'])->name('profile');
    Route::post('/update-info/{id}',[AdminController::class,'updateInfo'])->name('update.info');
    Route::post('/update-pass/{id}',[AdminController::class,'updatePass'])->name('update.pass');
});
Route::get('/',[LoginController::class,'viewSign'])->name('signin.view');
Route::post('/sigin-in',[LoginController::class,'postSignIn'])->name('signin');
//Logout
Route::get('/logout',[LoginController::class,'postLogout'])->name('logout');
