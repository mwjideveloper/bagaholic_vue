<?php

namespace App\Traits\ModelTraits;

trait ApparelCatalogScopes
{
    public function scopeApparelKeyword($query, $keyword, $category, $getIdBrand, $getIdStyle)
    {
        return $query->where([
            ['category', $category],
            [function ($query) use ($keyword, $getIdBrand, $getIdStyle) {
                $query->where('model', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('size', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('description', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('brand_id', $getIdBrand)
                        ->orWhere('style_id', $getIdStyle);
            }] 
        ]);
    }
}