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

	public function scopeFilter($query, array $filters)
	{
		if ($filters['search'] ?? false)
		{
			$query->where(fn ($query) => $query
				->where('en', 'like', "%{$filters['search']}%"))
				->orWhere('ka', 'like', "%{$filters['search']}%");
		}
	}
}
