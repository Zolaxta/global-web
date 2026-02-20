<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected by auth and admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/users/{user}/points', [AdminController::class, 'addPoints'])->name('admin.add_points');
    
    // User Management CRUD
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Rewards Management
    Route::get('/rewards', [AdminController::class, 'rewardsIndex'])->name('admin.rewards.index');
    Route::post('/rewards', [AdminController::class, 'storeReward'])->name('admin.rewards.store');
    Route::put('/rewards/{reward}', [AdminController::class, 'updateReward'])->name('admin.rewards.update');
    Route::delete('/rewards/{reward}', [AdminController::class, 'destroyReward'])->name('admin.rewards.destroy');
});

// Player Routes (Protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/catalog', [RewardController::class, 'index'])->name('rewards.catalog');
    Route::post('/rewards/{reward}/redeem', [RewardController::class, 'redeem'])->name('rewards.redeem');
    Route::get('/my-inventory', [RewardController::class, 'inventory'])->name('user.inventory');
});
