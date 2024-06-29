<?php

use App\Http\Controllers\PayController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\PhoneMiddleware;
use App\Http\Middleware\PinCodeMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => ['auth', 'verified', PhoneMiddleware::class,PinCodeMiddleware::class, ]
], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::put('/profile/pin-code', [ProfileController::class, 'pinCodeUpdate'])->name('pin-code.update');
        Route::get('/pay', [PayController::class, 'index'])->name('pay.index');
    });
});

require __DIR__.'/auth.php';
