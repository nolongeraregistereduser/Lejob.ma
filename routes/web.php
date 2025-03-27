<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes for all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

// Job seeker routes
Route::middleware(['auth', 'check.role:user'])->group(function () {
    Route::get('/create-cv', function () {
        return view('create-cv');
    });
    Route::get('/job-applications', function () {
        return view('job-applications');
    });
});

// Consultant routes
Route::middleware(['auth', 'check.role:consultant'])->group(function () {
    Route::get('/consultant/dashboard', function () {
        return view('consultant.dashboard');
    });
});

// Admin routes
Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/users', function () {
        return view('admin.users');
    });
});

