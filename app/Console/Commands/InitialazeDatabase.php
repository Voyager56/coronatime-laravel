<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class InitialazeDatabase extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'db:init';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$countries = Http::get('https://devtest.ge/countries')->json();
		$worldwideConfirmed = 0;
		$worldwideDeaths = 0;
		$worldwideRecovered = 0;
		foreach ($countries as $countryData)
		{
			$country = Country::create([
				'code' => $countryData['code'],
				'en'   => $countryData['name']['en'],
				'ka'   => $countryData['name']['ka'],
			]);

			$countryStat = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $countryData['code'],
			])->json();

			$country->statistics()->updateOrCreate([
				'country_name' => $countryStat['country'],
				'country_code' => $countryStat['code'],
				'confirmed'    => $countryStat['confirmed'],
				'deaths'       => $countryStat['deaths'],
				'recovered'    => $countryStat['recovered'],
			]);

			$worldwideConfirmed += $countryStat['confirmed'];
			$worldwideDeaths += $countryStat['deaths'];
			$worldwideRecovered += $countryStat['recovered'];
		}

		cache()->remember('worldWideStat', now()->addDay(), function () use ($worldwideConfirmed, $worldwideDeaths, $worldwideRecovered) {
			return [
				'confirmed' => $worldwideConfirmed,
				'deaths'    => $worldwideDeaths,
				'recovered' => $worldwideRecovered,
			];
		});
	}
}
