<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
	use HasFactory, Uuids;

	protected $fillable = [
		'name',
		'description',
		'cooking_time',
		'difficulty',
		'category_id',
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function images()
	{
		return $this->hasMany(Image::class);
	}

	public function steps()
	{
		return $this->hasMany(Step::class);
	}
}
