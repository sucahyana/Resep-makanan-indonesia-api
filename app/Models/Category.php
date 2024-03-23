<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
	use HasFactory, Uuids;

	protected $fillable = [
		'name',
		'description',
	];

	public function recipes()
	{
		return $this->belongsToMany(Recipe::class);
	}
}
