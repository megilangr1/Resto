<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $fillable = [
		'name', 'company_name', 'email', 'phone_number', 'address', 'description'
	];
}
