<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Consultant\AvailabilityController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Public pages
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/consultants', function () {
    return view('consultants.index');
})->name('consultants.index');

// User routes (regular users only)
Route::middleware(['auth', 'role:user'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // CV
    Route::get('/cv/create', function () {
        return view('cv.create');
    })->name('cv.create');
    
    // Jobs
    Route::get('/jobs', function () {
        return view('jobs.index');
    })->name('jobs.index');
    
    // Reservations
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create/{consultant_id}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    
    // Feedback
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
});

// Consultant routes
Route::middleware(['auth', 'role:consultant'])->prefix('consultant')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Consultant\ConsultantDashboardController::class, 'index'])->name('consultant.dashboard');
    
    // Availability
    Route::get('/availability', [AvailabilityController::class, 'index'])->name('consultant.availability');
    Route::post('/availability', [AvailabilityController::class, 'store'])->name('consultant.availability.store');
    Route::put('/availability/{availability}', [AvailabilityController::class, 'update'])->name('consultant.availability.update');
    Route::delete('/availability/{availability}', [AvailabilityController::class, 'destroy'])->name('consultant.availability.destroy');
    
    // Bookings
    Route::get('/bookings', [App\Http\Controllers\Consultant\ReservationController::class, 'index'])->name('consultant.bookings');
    Route::put('/bookings/{reservation}/confirm', [App\Http\Controllers\Consultant\ReservationController::class, 'confirm'])->name('consultant.bookings.confirm');
    Route::put('/bookings/{reservation}/cancel', [App\Http\Controllers\Consultant\ReservationController::class, 'cancel'])->name('consultant.bookings.cancel');
    
    // Profile routes
    Route::get('/profile', [App\Http\Controllers\Consultant\ConsultantProfileController::class, 'show'])->name('consultant.profile');
    Route::post('/profile/update', [App\Http\Controllers\Consultant\ConsultantProfileController::class, 'update'])->name('consultant.profile.update');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // User management
    Route::get('/users', [App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('admin.users');
    Route::post('/users/{id}/approve', [App\Http\Controllers\Admin\UserManagementController::class, 'approve'])->name('admin.users.approve');
    Route::post('/users/{id}/reject', [App\Http\Controllers\Admin\UserManagementController::class, 'reject'])->name('admin.users.reject');
    Route::post('/users/{id}/activate', [App\Http\Controllers\Admin\UserManagementController::class, 'activate'])->name('admin.users.activate');
    Route::delete('/users/{id}', [App\Http\Controllers\Admin\UserManagementController::class, 'delete'])->name('admin.users.delete');

    // Other admin routes
    Route::get('/jobs', [App\Http\Controllers\Admin\JobsController::class, 'index'])->name('admin.jobs');
    Route::get('/interviews', [App\Http\Controllers\Admin\InterviewsController::class, 'index'])->name('admin.interviews');
    Route::get('/statistics', [App\Http\Controllers\Admin\StatisticsController::class, 'index'])->name('admin.statistics');
});


