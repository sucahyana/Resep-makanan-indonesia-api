<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait Uuids
{
	protected static function boot()
	{
		parent::boot();

		static::creating(function (Model $model) {
			$model->{$model->getKeyName()} = Uuid::uuid4()->toString();
		});
	}

	public function getIncrementing()
	{
		return false;
	}

	public function getKeyType()
	{
		return 'string';
	}
}
