<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

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

Route::get('sign-in-google', [\App\Http\Controllers\UserController::class, 'google'])
    ->name('user.login.google');

Route::get('auth/google/callback', [\App\Http\Controllers\UserController::class, 'handleCallbackProvider'])
    ->name('user.google.callback');

Route::middleware('auth')->group(function () {

    Route::get('/checkout/success', [CheckoutController::class, 'success'])
        ->name('checkout.success');

    Route::get('/checkout/{camp:slug}', [CheckoutController::class, 'create'])
        ->name('checkout.create');

    Route::post('/checkout/{camp}', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])
        ->name("user.dashboard");
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
