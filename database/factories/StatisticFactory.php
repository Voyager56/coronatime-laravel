<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistic>
 */
class StatisticFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'country_code' => $this->faker->countryCode,
			'country_name' => $this->faker->country,
			'confirmed'    => $this->faker->numberBetween(0, 100),
			'deaths'       => $this->faker->numberBetween(0, 100),
			'recovered'    => $this->faker->numberBetween(0, 100),
		];
	}
}
