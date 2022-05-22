<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegistrationController extends Controller
{
	public function create()
	{
		return view('sessions.register');
	}

	public function store()
	{
		// dd(request()->all());

		$userData = request()->validate([
			'username'     => 'required|min:3',
			'email'        => 'required|email|unique:users',
			'password'     => 'required|min:6|confirmed',
		]);

		// dd($userData);

		$user = User::create([
			'username'     => $userData['username'],
			'email'        => $userData['email'],
			'password'     => bcrypt($userData['password']),
		]);

		event(new Registered($user));
		// dd($user);
	}
}
