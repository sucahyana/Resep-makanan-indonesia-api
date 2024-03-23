<?php

namespace App\Models;

use App\Traits\UuidsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
	use UuidsTrait;
	use HasFactory;

	protected $fillable = [
		'description',
		'order',
		'recipe_id',
	];

	public function recipe()
	{
		return $this->belongsTo(Recipe::class);
	}

	public function images()
	{
		return $this->hasMany(Image::class);
	}
}
