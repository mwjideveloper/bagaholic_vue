<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{   
    protected $connection = 'mysql2';
    
    public function imageable() {
    	return $this->morphTo();
    }
}
