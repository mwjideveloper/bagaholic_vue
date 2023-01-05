<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    // protected $connection = 'mysql2';

    public function wishlists() {
        return $this->morphTo(__FUNCTION__, 'customer_userable_type', 'customer_userable_id');
    }

    public function queuingRank() {
    	return $this->morphTo(__FUNCTION__, 'wish_stockable_id', 'wish_stockable_type');
    }
}
