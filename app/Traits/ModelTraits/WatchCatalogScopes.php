<?php

namespace App\Traits\ModelTraits;

trait WatchCatalogScopes
{
    public function scopeWatchKeyword($query, $keyword, $category, $getIdBrand)
    {
        return $query->where([
                ['category', $category],
                [function ($query) use ($keyword, $getIdBrand) {
                    $query->where('model', 'LIKE', '%'.$keyword.'%')
                            ->orWhere('size', 'LIKE', '%'.$keyword.'%')
                            ->orWhere('description', 'LIKE', '%'.$keyword.'%')
                            ->orWhere('brand_id', $getIdBrand)
                            ->orWhere('head', 'LIKE', '%'.$keyword.'%');
                }] 
            ]);
    }
}