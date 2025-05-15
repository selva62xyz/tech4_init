<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/logout', [GoogleController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::group(['middleware' => ['auth']], function () {

//User
Route::get('/userList', [UserController::class, 'userList'])->name('userList');
Route::get('/userAdd', [UserController::class, 'userAdd'])->name('userAdd');
Route::get('/userEdit/{id?}', [UserController::class, 'userEdit'])->name('userEdit');
Route::post('/userSave', [UserController::class, 'userSave'])->name('userSave');
Route::get('/user_activate', [UserController::class, 'deactivate'])->name('user_activate');
Route::get('/user_deactivate', [UserController::class, 'activate'])->name('user_deactivate');

});