<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
	public function loginUser(LoginRequest $request): RedirectResponse
	{
		if (Auth::attempt(['username' => $request->username, 'password' => $request->password]))
		{
			return back()->withErrors(['username'=>'You are now logged in.']);
		}
		elseif (Auth::attempt(['email'=> $request->username, 'password' => $request->password]))
		{
			return back()->withErrors(['username'=>'You are now logged in. email']);
		}

		return back()
		->withInput()
		->withErrors([
			'username' => __('credentials-match'),
			'password' => __('credentials-match'),
		]);
	}

	public function logoutUser(): RedirectResponse
	{
		auth()->logout();
		return redirect('/');
	}
}
