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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes for all authenticated users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

// Routes for job seekers (users)
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'role:user'])->name('user.dashboard');

Route::get('/cv/create', function () {
    return view('cv.create');
})->middleware(['auth', 'role:user'])->name('cv.create');

Route::get('/jobs', function () {
    return view('jobs.index');
})->middleware(['auth', 'role:user'])->name('jobs.index');




// Routes for consultants
Route::get('/consultant/dashboard', function () {
    return view('consultant.dashboard');
})->middleware(['auth', 'role:consultant'])->name('consultant.dashboard');

Route::get('/consultant/bookings', function () {
    return view('consultant.bookings');
})->middleware(['auth', 'role:consultant'])->name('consultant.bookings');

Route::get('/consultant/availability', function () {
    return view('consultant.availability');
})->middleware(['auth', 'role:consultant'])->name('consultant.availability');

Route::get('/consultant/profile', function () {
    return view('consultant.profile');
})->middleware(['auth', 'role:consultant'])->name('consultant.profile');

// Routes for admins
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    route::get('/admin/user-management', function () {
        return view('admin.user-management.index');
    })->name('admin.user-management');

    Route::get('/admin/jobs', function () {
        return view('admin.jobs.index');
    })->name('admin.jobs');


});

// Test route
Route::get('/test-middleware', function () {
    return 'Middleware is working!';
})->middleware(['auth', 'role:admin']);


