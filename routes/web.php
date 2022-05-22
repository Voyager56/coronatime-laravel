<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	return redirect('/email/verify');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/', [SessionController::class, 'index'])->name('home');
Route::post('/login', [SessionController::class, 'store'])->name('login');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

Route::get('/signup', [RegistrationController::class, 'create'])->name('register');
Route::post('/signup', [RegistrationController::class, 'store'])->name('register');

// Route::get('/send-mail', )
