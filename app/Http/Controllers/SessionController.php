<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
	public function loginUser(LoginRequest $request): RedirectResponse
	{
		$username = $request->username;
		$field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		if (Auth::attempt([$field => $username, 'password' => $request->password]))
		{
			return redirect()->route('home');
		}

		return redirect()->back()->withErrors(['password' => 'incorrect password']);
	}

	public function logoutUser(): RedirectResponse
	{
		auth()->logout();
		return redirect(route('home'));
	}
}
