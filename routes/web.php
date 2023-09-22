<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('sign-in-google',[\App\Http\Controllers\UserController::class,'google'])
    ->name('user.login.google');

Route::get('auth/google/callback',[\App\Http\Controllers\UserController::class,'handleCallbackProvider'])
    ->name('user.google.callback');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/checkout-success', function () {
    return view('success_checkout');
})->name('checkout-success');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
