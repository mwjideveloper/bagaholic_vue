<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apparelcatalog extends Model
{
    // protected $connection = 'mysql2';

    function brand(){
    	return $this->belongsto('App\Brand');
    }

    function style(){
    	return $this->belongsto('App\Style');
    }
}
