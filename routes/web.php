<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\CvController;

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

Route::get('/consultants', [App\Http\Controllers\ConsultantController::class, 'index'])->name('consultants.index');
Route::get('/consultants/{id}', [App\Http\Controllers\ConsultantController::class, 'show'])->name('consultants.show');

Route::get('/jobs', [App\Http\Controllers\RemoteJobController::class, 'index'])->name('jobs.remote');

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
    
    // Add this route for direct booking
    Route::post('/book-session', [\App\Http\Controllers\user\ReservationController::class, 'bookSession'])->name('user.book-session');
    
    // User reservation routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::resource('reservations', \App\Http\Controllers\user\ReservationController::class)
            ->only(['index', 'create', 'store', 'show']);
            
        // Routes de feedback
        Route::get('reservations/{reservation}/feedback', [\App\Http\Controllers\user\FeedbackController::class, 'create'])
            ->name('feedback.create');
        Route::post('reservations/{reservation}/feedback', [\App\Http\Controllers\user\FeedbackController::class, 'store'])
            ->name('feedback.store');
    });
});

// CV specific routes - no auth middleware temporarily
Route::get('/api/cv/current', [CvController::class, 'getCurrentCv']);
Route::post('/api/cv/upload-pdf', [CvController::class, 'uploadPdf']);

// Consultant routes
Route::middleware(['auth', 'role:consultant'])->prefix('consultant')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Consultant\ConsultantDashboardController::class, 'index'])->name('consultant.dashboard');
    Route::get('/availability', [App\Http\Controllers\Consultant\ConsultantDashboardController::class, 'availability'])->name('consultant.availability');
    
    Route::get('/bookings', [App\Http\Controllers\Consultant\ConsultantBookingsController::class, 'index'])->name('consultant.bookings');
    Route::post('/bookings/{reservation}/accept', [App\Http\Controllers\Consultant\ConsultantBookingsController::class, 'accept'])->name('consultant.bookings.accept');
    Route::post('/bookings/{reservation}/reject', [App\Http\Controllers\Consultant\ConsultantBookingsController::class, 'reject'])->name('consultant.bookings.reject');
    Route::post('/bookings/{reservation}/complete', [App\Http\Controllers\Consultant\ConsultantBookingsController::class, 'complete'])->name('consultant.bookings.complete');
    
    // Profile routes
    Route::get('/profile', [App\Http\Controllers\Consultant\ConsultantProfileController::class, 'show'])->name('consultant.profile');
    Route::post('/profile/update', [App\Http\Controllers\Consultant\ConsultantProfileController::class, 'update'])->name('consultant.profile.update');
});

Route::middleware(['auth', 'role:consultant'])->prefix('consultant')->name('consultant.')->group(function () {
    Route::get('/availability', [App\Http\Controllers\Consultant\AvailabilityController::class, 'index'])->name('availability.index');
    Route::get('/availability/create', [App\Http\Controllers\Consultant\AvailabilityController::class, 'create'])->name('availability.create');
    Route::post('/availability', [App\Http\Controllers\Consultant\AvailabilityController::class, 'store'])->name('availability.store');
    Route::delete('/availability/{availability}', [App\Http\Controllers\Consultant\AvailabilityController::class, 'destroy'])->name('availability.destroy');
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


