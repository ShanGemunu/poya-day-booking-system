<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PoyaDayController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PreventAuthUsers;

// for all users
// Route::post('/testing', action: [PoyaDayController::class, 'testing'])->name('api.testing-query');
Route::post('/make-booking', action: [BookingController::class, 'makeBooking'])->name('api.make-booking');
Route::post('/poya-days', action: [PoyaDayController::class, 'poyaDays'])->name('api.poya-days');

// only for guest users
Route::middleware(PreventAuthUsers::class)->group(function () {
    Route::post('/login', action: [AuthController::class, 'login'])->name('api.login');
});

// only for all authenticated users
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', action: [AuthController::class, 'logout'])->name('api.logout');
    
});

// only for admins 
Route::middleware(['auth:sanctum','abilities:adminAccess'])->group(function () {
    Route::post('/approve-bookings', action: [BookingController::class, 'approveBooking'])->name('api.approve-bookings');
    Route::post('/pending-bookings', action: [BookingController::class, 'pendingBookings'])->name('api.pending-bookings');
});