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

Route::get('/email/verify', [EmailController::class, 'verifyEmailView'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'confirmEmail'])->middleware(['auth'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailController::class, 'emailSentView'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::view('/', 'sessions.login')->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, 'loginUser'])->name('login.store');
Route::post('/logout', [SessionController::class, 'logoutUser'])->name('logout');

Route::view('/signup', 'sessions.register')->name('register');
Route::post('/signup', [RegistrationController::class, 'registration'])->name('register');

Route::get('/home', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/countries', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('show');

Route::view('/forgot-password', 'auth.reset')->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendPasswordResetEmail'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'saveNewPassword'])->middleware('guest')->name('password.update');

Route::get('locale/{lang}', [LangController::class, 'index'])->name('lang');
