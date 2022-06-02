<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;

class RegistrationController extends Controller
{
	public function registration(UserRequest $request): View
	{
		$userData = $request->validated();

		$user = User::create([
			'username'     => $userData['username'],
			'email'        => $userData['email'],
			'password'     => bcrypt($userData['password']),
		]);

		auth()->login($user);
		event(new Registered($user));

		return view('mail.verify', [
			'message'     => 'We have sent you a confirmation email',
			'slug'        => '',
			'form'        => '',
			'link'        => '',
			'linkMessage' => '',
		]);
	}
}
