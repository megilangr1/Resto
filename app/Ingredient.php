<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
  protected $fillable = [
		'name', 'description', 'price', 'unit_id'
	];

	public function unit()
	{
		return $this->belongsTo('App\Unit');
	}
}
