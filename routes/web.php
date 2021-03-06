<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Artisan;
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

    //Admin
    Route::post('/users-limt/{token}',[AdminController::class,'setting'])->name('user.limit');

    Route::get('/users',[AdminController::class,'viewUsers'])->name('users');
    Route::post('/add-user',[AdminController::class,'createUser'])->name('adduser');
    Route::get('/delete-user',[AdminController::class,'delete'])->name('users.delete');

    Route::get('/profile/{id}',[AdminController::class,'getProfile'])->name('profile');
    Route::post('/update-info/{id}',[AdminController::class,'updateInfo'])->name('update.info');
    Route::post('/update-pass/{id}',[AdminController::class,'updatePass'])->name('update.pass');
    //Data
    Route::get('/data/{token}',[AdminController::class,'viewAdmin'])->name('data');
    Route::get('/edit-data/{id}',[DataController::class,'editData'])->name('edit.data');
    Route::post('/update-data/{id}',[DataController::class,'updateData'])->name('update.data');
    Route::post('/import-data/{token}',[DataController::class,'importData'])->name('import.data');
    Route::get('/export-data/{token}',[DataController::class,'exportData'])->name('export.data');
    Route::post('/import-file',[DataController::class,'importFile'])->name('import.file');
    Route::get('/delete-data',[DataController::class,'delete'])->name('data.delete');
    Route::get('/delete-all',[DataController::class,'deleteAll'])->name('data.delete.all');

    Route::get('/get-delete',[DataController::class,'getDelete'])->name('getDelete');
    Route::get('/get-user-delete',[AdminController::class,'getDelete'])->name('user.getDelete');
    //Document
    Route::get('/document',[AdminController::class,'documentApi'])->name('document');

});
Route::get('/',[LoginController::class,'viewSign'])->name('signin.view');
Route::post('/sigin-in',[LoginController::class,'postSignIn'])->name('signin');
//Logout
Route::get('/logout',[LoginController::class,'postLogout'])->name('logout');
Route::get('/delete-files',[DataController::class,'deleteFlies']);

Route::get('clear', function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return redirect()->back();
});
