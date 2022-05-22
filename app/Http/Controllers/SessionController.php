<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SessionController extends Controller
{
	public function index(): View
	{
		return view('sessions.login');
	}

	public function store(LoginRequest $request)
	{
		$request->validated();

		if (Auth::attempt(['username' => $request->username, 'password' => $request->password], request()->has('remember')))
		{
			return redirect()->route('home');
		}

		return back()
		->withInput()
		->withErrors([
			'username' => 'These credentials do not match our records.',
			'password' => 'These credentials do not match our records.',
		]);
	}

	public function destroy()
	{
		auth()->logout();
		return redirect('/');
	}
}
