<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CvController;
use App\Http\Controllers\AuthController;



Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('cv', CvController::class);
    Route::get('cv/current', [CvController::class, 'getCurrentCv']);
    Route::post('cv/upload-pdf', [CvController::class, 'uploadPdf']);
});