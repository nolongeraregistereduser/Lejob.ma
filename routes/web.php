<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/register', function () {
    return view('register');
});