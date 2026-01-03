<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/my-reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/hotels/{hotel}/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('hotels', \App\Http\Controllers\Admin\HotelManagementController::class);
    
    Route::get('/reservations', [\App\Http\Controllers\Admin\ReservationManagementController::class, 'index'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/status', [\App\Http\Controllers\Admin\ReservationManagementController::class, 'updateStatus'])->name('reservations.update-status');
    Route::delete('/reservations/{reservation}', [\App\Http\Controllers\Admin\ReservationManagementController::class, 'destroy'])->name('reservations.destroy');
});

require __DIR__.'/auth.php';
