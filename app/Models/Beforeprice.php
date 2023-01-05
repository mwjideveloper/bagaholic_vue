<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beforeprice extends Model
{
    public function beforePriceable() {
    	return $this->morphTo();
    }
}
