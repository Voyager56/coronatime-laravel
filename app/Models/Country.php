<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	use HasFactory;

	protected $fillable = [
		'code', 'en', 'ka',
	];

	public function statistics()
	{
		return $this->hasOne(Statistic::class);
	}

	public function scopeFilter($query, $search)
	{
		if ($search ?? false)
		{
			$query->where(fn ($query) => $query
				->where('en', 'like', "%{$search}%"))
				->orWhere('ka', 'like', "%{$search}%");
		}
	}
}
