<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
   protected $guarded = ['id'];

	public function owner()
	{
		return $this->belongsTo('App\User', 'sales_rep', 'name');
	}

    
}