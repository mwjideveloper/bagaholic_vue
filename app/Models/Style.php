<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    // protected $connection = 'mysql2';

    public function photos(){
    	return $this->morphMany('App\Photo','imageable');
    }
}
