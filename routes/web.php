<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (User facing)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/rooms', [PublicController::class, 'rooms'])->name('rooms');
Route::get('/rooms/{id}', [PublicController::class, 'detail'])->name('rooms.detail');
Route::get('/tentang', [PublicController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rooms CRUD
    Route::get('/rooms', [AdminRoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [AdminRoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [AdminRoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}', [AdminRoomController::class, 'show'])->name('rooms.show');
    Route::get('/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{id}', [AdminRoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{id}', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');

    // Quick status update (AJAX)
    Route::patch('/rooms/{id}/status', [AdminRoomController::class, 'updateStatus'])->name('rooms.updateStatus');

    // Room Types CRUD
    Route::get('/room-types', [RoomTypeController::class, 'index'])->name('room-types.index');
    Route::get('/room-types/create', [RoomTypeController::class, 'create'])->name('room-types.create');
    Route::post('/room-types', [RoomTypeController::class, 'store'])->name('room-types.store');
    Route::get('/room-types/{id}/edit', [RoomTypeController::class, 'edit'])->name('room-types.edit');
    Route::put('/room-types/{id}', [RoomTypeController::class, 'update'])->name('room-types.update');
    Route::delete('/room-types/{id}', [RoomTypeController::class, 'destroy'])->name('room-types.destroy');

    // Audit Log
    Route::get('/audits', [AuditController::class, 'index'])->name('audits');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

    // Settings
    Route::get('/settings/contact', [SettingController::class, 'contact'])->name('settings.contact');
    Route::put('/settings/contact', [SettingController::class, 'updateContact'])->name('settings.contact.update');
    Route::get('/settings/password', [SettingController::class, 'password'])->name('settings.password');
    Route::put('/settings/password', [SettingController::class, 'updatePassword'])->name('settings.password.update');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
