<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
// Guest Routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Authenticated & Verified Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Waste Management Routes
    Route::resource('waste', WasteController::class);
    Route::get('/wastes', [WasteController::class, 'index'])->name('wastes.index');
    Route::get('/waste/image/{id}', [WasteController::class, 'getImage'])->name('waste.image');
    // Notification Routes
    Route::get('/notifications', NotificationController::class)->name('notifications.index');
    // Chat Routes
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{id}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats/{chatId}/message', [MessageController::class, 'store'])->name('message.store');
});

require __DIR__.'/auth.php';