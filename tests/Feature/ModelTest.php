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
		Country::create([
			'code' => 'test',
			'en'   => 'test',
			'ka'   => 'ტესტ',
		]);
		$country = Country::latest()->filter(['search' => 'test'])->get()->first();
		$this->assertTrue($country->ka === 'ტესტ');
	}
}
