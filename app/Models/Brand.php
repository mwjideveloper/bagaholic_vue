<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // protected $connection = 'mysql2';

    public function photos(){
    	return $this->morphMany('App\Photo','imageable');
    }
    
    public function scopeFindBrandsWithStocksWithImage($query)
    {
        return $query->leftJoin('apparelcatalogs', 'apparelcatalogs.brand_id', '=', 'brands.id')
                    ->join('stocklists', function ($join) {
                        $join->on('stocklists.catalogable_id', '=', 'apparelcatalogs.id')
                            ->where('stocklists.catalogable_type', 'App\Apparelcatalog');
                    })
                    ->join('photos', function ($join) {
                        $join->on('photos.imageable_id', '=', 'stocklists.id')
                            ->where([['photos.imageable_type', 'App\Stocklist'],['photos.position', 'FRONT IMAGE']]);
                    });
    }
}
