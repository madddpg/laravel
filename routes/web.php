<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuCartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


Route::get('/', [MenuCartController::class, 'home'])->name('home');

// Admin side
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Admin Menu CRUD
    Route::get('/admin/menu', [AdminController::class, 'menuIndex'])->name('admin.menu.index');
    Route::get('/admin/menu/create', [AdminController::class, 'menuCreate'])->name('admin.menu.create');
    Route::post('/admin/menu', [AdminController::class, 'menuStore'])->name('admin.menu.store');
    Route::get('/admin/menu/{id}/edit', [AdminController::class, 'menuEdit'])->name('admin.menu.edit');
    Route::put('/admin/menu/{id}', [AdminController::class, 'menuUpdate'])->name('admin.menu.update');
    Route::delete('/admin/menu/{id}', [AdminController::class, 'menuDestroy'])->name('admin.menu.destroy');
    
    // Admin Logs
    Route::get('/admin/logs', [AdminController::class, 'logsIndex'])->name('admin.logs.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/menu', [MenuCartController::class, 'menu'])->name('menu');
    Route::post('/cart/add/{id}', [MenuCartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/increase/{id}', [MenuCartController::class, 'increaseQuantity'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [MenuCartController::class, 'decreaseQuantity'])->name('cart.decrease');
    Route::get('/cart', [MenuCartController::class, 'cart'])->name('cart');
    Route::post('/checkout', [MenuCartController::class, 'checkout'])->name('checkout');
});

// Authentications
Route::get('/register', [UserController::class, 'showRegister'])->name('register.show');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// User Management
Route::middleware('auth')->group(function () {
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
