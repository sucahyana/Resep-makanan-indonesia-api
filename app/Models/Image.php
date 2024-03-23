<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	use HasFactory, Uuids;

	protected $fillable = [
		'name',
		'path',
		'type',
		'recipe_id',
		'step_id',
	];

	public function recipe()
	{
		return $this->belongsTo(Recipe::class);
	}

	public function step()
	{
		return $this->belongsTo(Step::class);
	}
}
