<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use App\Models\Country;

class Kernel extends ConsoleKernel
{
	/**
	 * Define the application's command schedule.
	 *
	 * @param \Illuminate\Console\Scheduling\Schedule $schedule
	 *
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->call($this->fetch())->daily();
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__ . '/Commands');

		require base_path('routes/console.php');
	}

	private function fetch(): Void
	{
		$countries = Country::all();
		$worldwideConfirmed = 0;
		$worldwideDeaths = 0;
		$worldwideRecovered = 0;
		foreach ($countries as $country)
		{
			$countryStat = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
			])->json();

			$country->statistics()->update([
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

		cache('worldWideStat', now()->addDay(), function () use ($worldwideConfirmed, $worldwideDeaths, $worldwideRecovered) {
			return [
				'confirmed' => $worldwideConfirmed,
				'deaths'    => $worldwideDeaths,
				'recovered' => $worldwideRecovered,
			];
		});
	}
}
