<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SessionController extends Controller
{
	public function index(): View
	{
		return view('sessions.login');
	}

	public function store(LoginRequest $request): RedirectResponse
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
			'username' => 'These credentials do not match our records.',
			'password' => 'These credentials do not match our records.',
		]);
	}

	public function destroy(): RedirectResponse
	{
		auth()->logout();
		return redirect('/');
	}
}
