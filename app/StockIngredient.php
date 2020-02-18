<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIngredient extends Model
{
		protected $fillable = [
			'ingredient_id', 'first_stock', 'stock_in', 'stock_out', 'stock_adjustment'
		];

		public function ingredient()
		{
			return $this->belongsTo('App\Ingredient');
		}
}
