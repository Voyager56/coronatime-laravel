<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CommandTest extends TestCase
{
	public function test_if_fetch_command_works()
	{
		Http::fake([
			'https://devtest.ge/countries' => Http::response([
				[
					'code' => 'test',
					'name' => [
						'ka' => 'ტესტ',
						'en' => 'test',
					],
				],
			]),

			'https://devtest.ge/get-country-statistics' => Http::response([
				'country'      => 'country',
				'code'         => 'countrycode',
				'confirmed'    => 123123,
				'deaths'       => 223123,
				'recovered'    => 22313,
			], 200, ['HEADERS']),
		]);

		$this->artisan('generate:database')->assertExitCode(0);
		$this->assertDatabaseHas('countries', [
			'code' => 'test',
			'en'   => 'test',
			'ka'   => 'ტესტ',
		]);
		$this->assertDatabaseHas('statistics', [
			'country_name' => 'country',
			'country_code' => 'countrycode',
			'confirmed'    => 123123,
			'deaths'       => 223123,
			'recovered'    => 22313,
		]);
	}
}
