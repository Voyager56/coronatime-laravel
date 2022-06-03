<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
	public function sendPasswordResetEmail(Request $request): RedirectResponse|View
	{
		$email = $request->validate(['email' => 'required|email']);
		$user = User::where('email', $email)->first();
		if (!$user)
		{
			return redirect()->back()->withErrors(['email' => 'Email not found']);
		}

		$token = Str::random(64);
		DB::table('password_resets')->insert([
			'email'      => $request->email,
			'token'      => $token,
			'created_at' => now(),
		]);

		Mail::send('mail.signup', [
			'url'          => url('/reset-password/' . $token),
			'msg'          => 'Recover password',
			'clickMessage' => 'click this button to recover a password',
			'buttonText'   => 'RECOVER PASSWORD',
		], function ($message) use ($request) {
			$message->to($request->email);
			$message->subject('Reset Password');
		});

		return view('mail.verify', [
			'message'     => 'Please check your email to reset your password',
			'form'        => '',
			'link'        => '',
			'slug'        => '',
			'linkMessage' => '',
		]);
	}

	public function saveNewPassword(PasswordresetRequest $request): RedirectResponse
	{
		$data = $request->validated();

		$updatePasswordUser = DB::table('password_resets')
		->where([
			'token' => $data['token'],
		])
		->first();

		if (!$updatePasswordUser)
		{
			return back()->withInput()->with('error', 'Invalid token!');
		}
		$user = User::where('email', $updatePasswordUser->email)->first();
		$user->update(['password' => bcrypt($request->password)]);

		DB::table('password_resets')->where(['email'=> $user->email])->delete();

		return redirect('/')->with('message', 'Your password has been changed!');
	}

	public function resetPassword(string $token): View
	{
		return view('auth.reset-password', ['token' => $token]);
	}
}
