<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class EmailController extends Controller
{
	public function verifyEmailView(): View
	{
		return view('mail.verify', [
			'message'     => 'We have sent you a confirmation email, if you want to resend it, please click the button below.',
			'form'        => 'yes',
			'link'        => '',
			'slug'        => 'email/verification-notification',
			'linkMessage' => 'Resend confirmation email',
		]);
	}

	public function confirmEmail(EmailVerificationRequest $request): View
	{
		$request->fulfill();
		auth()->logout();
		return view('mail.verify', [
			'message'     => 'Your account is confirmed, you can sign in',
			'form'        => '',
			'link'        => 'yes',
			'slug'        => '',
			'linkMessage' => 'Sign in',
		]);
	}

	public function emailSentView(Request $request): RedirectResponse
	{
		$request->user()->sendEmailVerificationNotification();
		return back()->with('message', 'Verification link sent!');
	}
}
