<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use App\Models\Country;
use Illuminate\Console\Command;

class FetchDatabase extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'fetch:database';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'fetches statistics and fills database';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$worldwideConfirmed = 0;
		$worldwideDeaths = 0;
		$worldwideRecovered = 0;
		foreach (Country::all() as $country)
		{
			$countryStat = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
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
