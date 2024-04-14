<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LogNotification;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendMessage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [Dashboard::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sendMessage/{id}', [SendMessage::class, 'create'])->middleware(['auth'])->name('sendMessage');

Route::post('/saveMessage', [SendMessage::class, 'store'])->middleware(['auth'])->name('saveMessage');

Route::get('/logNotification', [LogNotification::class, 'create'])->middleware(['auth'])->name('logNotification');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
