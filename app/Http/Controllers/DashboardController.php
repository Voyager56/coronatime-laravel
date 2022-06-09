<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\View\View;

class DashboardController extends Controller
{
	public function index(): View
	{
		return view('components.worldwide', ['stats' => cache('worldWideStat')]);
	}

	public function show(): View
	{
		return view('components.countries', [
			'countries' => Country::latest()->filter(request()->only(['search']))->get(),
		]);
	}
}
