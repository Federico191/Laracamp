<?php

use App\Http\Controllers\Admin\CheckoutController as AdminCheckout;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
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

//socialite route
Route::get('sign-in-google', [\App\Http\Controllers\UserController::class, 'google'])
    ->name('user.login.google');
Route::get('auth/google/callback', [\App\Http\Controllers\UserController::class, 'handleCallbackProvider'])
    ->name('user.google.callback');

//midtrans route
Route::get('payment/success',[\App\Http\Controllers\UserController::class,'midtransCallback']);
Route::post('payment/success',[\App\Http\Controllers\UserController::class,'midtransCallback']);

Route::middleware('auth')->group(function () {

    Route::get('/checkout/success', [CheckoutController::class, 'success'])
        ->name('checkout.success')->middleware('EnsureUserRole:user');

    Route::get('/checkout/{camp:slug}', [CheckoutController::class, 'create'])
        ->name('checkout.create')->middleware('EnsureUserRole:user');

    Route::post('/checkout/{camp}', [CheckoutController::class, 'store'])
        ->name('checkout.store')->middleware('EnsureUserRole:user');

    //dashboard
    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard']);

    //user dashboard
    Route::prefix('user/dashboard')->namespace('User')->middleware('EnsureUserRole:user')
        ->name('user.')->group(function () {
            Route::get('/', [UserDashboard::class, 'index'])->name('dashboard');
        });

    //admin dashboard
    Route::prefix('admin/dashboard')->namespace('Admin')->middleware('EnsureUserRole:admin')
        ->name('admin.')->group(function () {
            Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

            //admin checkout
            Route::post('checkout/{checkout}', [AdminCheckout::class, 'update'])->name('checkout.update');
        });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
