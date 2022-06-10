<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Console\Command;

class FetchDatabase extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'generate:database';

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
		$countries = Http::get('https://devtest.ge/countries')->json();
		foreach ($countries as $countryData)
		{
			$country = Country::updateOrCreate([
				'code' => $countryData['code'],
				'en'   => $countryData['name']['en'],
				'ka'   => $countryData['name']['ka'],
			]);
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
		}
		cache()->remember('worldWideStat', now()->addDay(), function () {
			return [
				'confirmed' => Statistic::sum('confirmed'),
				'deaths'    => Statistic::sum('deaths'),
				'recovered' => Statistic::sum('recovered'),
			];
		});
	}
}
