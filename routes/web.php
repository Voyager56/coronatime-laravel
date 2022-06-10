<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LangController;
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

Route::get('locale/{lang}', [LangController::class, 'index'])->name('lang');

Route::middleware('auth')->group(function () {
	Route::get('/email/verify', [EmailController::class, 'verifyEmailView'])->name('verification.notice');
	Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'confirmEmail'])->name('verification.verify');
	Route::post('/email/verification-notification', [EmailController::class, 'emailSentView'])->middleware('throttle:6,1')->name('verification.send');
	Route::get('/home', [DashboardController::class, 'index'])->middleware('verified')->name('home');
	Route::get('/countries', [DashboardController::class, 'show'])->middleware('verified')->name('show');
	Route::post('/logout', [SessionController::class, 'logoutUser'])->name('logout');
});

Route::middleware('guest')->group(function () {
	Route::view('/', 'sessions.login')->name('login');
	Route::post('/login', [SessionController::class, 'loginUser'])->name('login.store');

	Route::view('/signup', 'sessions.register')->name('register');
	Route::post('/signup', [RegistrationController::class, 'registration'])->name('register');

	Route::view('/forgot-password', 'auth.reset')->name('forgot-password.page');
	Route::post('/forgot-password', [PasswordResetController::class, 'sendPasswordResetEmail'])->name('password.email');
	Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPassword'])->name('password.reset');
	Route::post('/reset-password', [PasswordResetController::class, 'saveNewPassword'])->name('password.update');
});
