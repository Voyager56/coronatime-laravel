<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/email/verify', [EmailController::class, 'index'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'store'])->middleware(['auth'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailController::class, 'update'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', [SessionController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

Route::get('/signup', [RegistrationController::class, 'create'])->name('register');
Route::post('/signup', [RegistrationController::class, 'store'])->name('register');

Route::get('/home', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('/forgot-password', [PasswordResetController::class, 'index'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'create'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'show'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'update'])->middleware('guest')->name('password.update');

Route::get('locale/{lang}', function ($lang) {
	app()->setLocale($lang);
	session()->put('lang', $lang);
	return redirect()->back();
});
