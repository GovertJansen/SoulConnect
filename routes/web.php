<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/detail/{id}', function ($id) {
    return view('pages.profileDetail', ['id' => $id]);
});

Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware('auth');


//Route::get('/dashboard', function () {
//    return view('pages.dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard', [RegisteredUserController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Register User Page
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// Store User
Route::post('/users/store', [RegisteredUserController::class, 'store'])->name('storeUser');

// Send Verification Email to User
Route::get('/send-verification-email', [MailController::class, 'sendVerificationEmail'])->name('sendVerificationEmail');

// User Email Verification
Route::get('/email/verify', [MailController::class, 'verifyEmail'])->name('verifyEmail');

require __DIR__.'/auth.php';
