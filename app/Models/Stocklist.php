<?php

namespace App\Models;

use App\Traits\ModelTraits\StocklistScopes;

use Illuminate\Database\Eloquent\Model;

class Stocklist extends Model
{   
    use StocklistScopes;

    // protected $connection = 'mysql2';

    public function apparelCatalogable()
    {
        return $this->morphTo(__FUNCTION__, 'catalogable_type', 'catalogable_id')->join('styles', 'styles.id', '=', 'apparelcatalogs.style_id')->join('brands', 'brands.id', '=', 'apparelcatalogs.brand_id');
    }

    public function watchCatalogable()
    {
        return $this->morphTo(__FUNCTION__, 'catalogable_type', 'catalogable_id')->join('brandnames', 'brandnames.id', '=', 'watchcatalogs.brand_id');
    }

    public function frontPhoto()
    {
        return $this->morphTo(__FUNCTION__, 'catalogable_type', 'catalogable_id')
        ->leftJoin('photos', 'photos.imageable_id', '=', 'apparelcatalogs.id')
        ->where('photos.imageable_type','App\Apparelcatalog');
    }
    
    public function frontStockPhoto()
    {
        return $this->morphMany('App\Photo','imageable')->where('position', 'FRONT IMAGE')->latest()->take(1);
    }

    public function backStockPhoto()
    {
        return $this->morphMany('App\Photo','imageable')->where('position', 'BACK IMAGE')->latest()->take(1);
    }

    public function sideStockPhoto()
    {
        return $this->morphMany('App\Photo','imageable')->where('position', 'SIDE IMAGE')->latest()->take(1);
    }

    public function interiorStockPhoto()
    {
        return $this->morphMany('App\Photo','imageable')->where('position', 'INTERIOR IMAGE')->latest()->take(1);
    }

    function scoreCondition()
    {
        return $this->belongsto('App\Condition','condition_id','id');
    }

    function branch()
    {
        return $this->belongsto('App\Branch','branch_id','id');
    }    
}
