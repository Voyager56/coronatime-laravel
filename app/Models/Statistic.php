<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	use HasFactory;

	protected $fillable = [
		'country_code', 'country_name', 'confirmed', 'deaths', 'recovered',
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}
}
