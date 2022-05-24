<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
	public function index()
	{
		return view('auth.reset');
	}

	public function create(Request $request)
	{
		$request->validate(['email' => 'required|email']);
	}
}
