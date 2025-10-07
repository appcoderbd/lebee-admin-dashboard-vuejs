<?php

use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\HospitalController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SpecialistController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Specialist routes resources
    Route::resource('/specialists', SpecialistController::class);
    Route::resource('/hospitals', HospitalController::class);

    Route::get('/doctors/leave', [DoctorsController::class, 'leave'])->name('doctors.leave');

    Route::resource('/doctors', DoctorsController::class);

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
