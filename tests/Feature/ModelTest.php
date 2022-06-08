<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Statistic;
use Tests\TestCase;

class ModelTests extends TestCase
{
	public function test_country_statistics_relationtship()
	{
		$statistic = Statistic::all()->first();

		$this->assertInstanceOf(Country::class, $statistic->country);
	}

	public function test_country_search_function()
	{
		$country = Country::latest()->filter(['search' => 'Geo'])->get()->first();
		$this->assertTrue($country->en === 'Georgia');
	}
}
