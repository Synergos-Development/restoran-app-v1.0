<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');

Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Authentication routes (simple controllers)
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});

