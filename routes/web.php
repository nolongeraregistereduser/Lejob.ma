<?php

use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function () {
    return view('about');
});


Route::get('/contact', function () {
    return view('contact');
});


Route::get('/create-cv', function () {
    return view('create-cv');
});




Route::get('/register', [AuthController::class, 'showRegister']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

