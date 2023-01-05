<?php

namespace App\Traits\ModelTraits;

use DB;

trait StocklistScopes
{   
    public function scopeIndividualStockRelatedTables($query)
    {
        return $query->leftJoin('apparelcatalogs', function ($join) {
            $join->on('stocklists.catalogable_id', '=', 'apparelcatalogs.id')
                ->where('stocklists.catalogable_type', 'App\Apparelcatalog');
        })
        ->join('photos', function ($join) {
            $join->on('photos.imageable_id', '=', 'stocklists.id')
                ->where('photos.imageable_type', 'App\Stocklist');
        })
        ->leftJoin('conditions', 'conditions.id', '=', 'stocklists.condition_id')
        ->leftJoin('styles', 'styles.id', '=', 'apparelcatalogs.style_id')
        ->leftJoin('brands', 'brands.id', '=', 'apparelcatalogs.brand_id')
        ->leftJoin('branches', 'branches.id', '=', 'stocklists.branch_id');
    }

    public function scopeStockRelatedTables($query)
    {
        return $query->leftJoin('apparelcatalogs', function ($join) {
            $join->on('stocklists.catalogable_id', '=', 'apparelcatalogs.id')
                ->where('stocklists.catalogable_type', 'App\Apparelcatalog');
        })
        ->join('photos', function ($join) {
            $join->on('photos.imageable_id', '=', 'stocklists.id')
                ->where([['photos.imageable_type', 'App\Stocklist'],['photos.position', 'FRONT IMAGE']]);
        })
        ->leftJoin('conditions', 'conditions.id', '=', 'stocklists.condition_id')
        ->leftJoin('styles', 'styles.id', '=', 'apparelcatalogs.style_id')
        ->leftJoin('brands', 'brands.id', '=', 'apparelcatalogs.brand_id')
        ->leftJoin('branches', 'branches.id', '=', 'stocklists.branch_id');
    }

    public function scopeIndividualStockSelectedFields($query)
    {
        return $query->select('stocklists.id as id','stocklists.catalogable_id','stocklists.catalogable_type','stocklists.tag_price','apparelcatalogs.category',
        'styles.style','brands.brand_name','apparelcatalogs.brand_id','apparelcatalogs.style_id','apparelcatalogs.catalog_notes','apparelcatalogs.model','apparelcatalogs.color','apparelcatalogs.description','apparelcatalogs.size', 'stocklists.before_price','photos.path','score_condition_id','stocklists.other_remarks','stocklists.created_at','photos.position');
    }

    public function scopeStockSelectedFields($query)
    {
        return $query->select('stocklists.id as id','stocklists.tag_price','apparelcatalogs.category',
        'styles.style','brands.brand_name','apparelcatalogs.color','apparelcatalogs.description','apparelcatalogs.size', 'stocklists.before_price','photos.path','score_condition_id','stocklists.created_at');
    }

    public function scopeStockWhereSearchKeyword($query, $request)
    {   
        $keyword = request('keyword');
        
        if($keyword)
        {
            return $query->where([
                [function ($query) use ($keyword){
                        $query->where('brand_name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('style', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('category', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('stocklists.id', $keyword);
                }],
                ['stock_status', 'DISPLAY']
            ]);
        }
        elseif(request('category') != "ALL" && request('brandId') && request('styleId'))
        {
            return $query->where([
                ['stock_status', 'DISPLAY'],
                ['category', request('category')],
                ['apparelcatalogs.brand_id', request('brandId')],
                ['apparelcatalogs.style_id', request('styleId')]
            ]);
        }
        elseif(request('category') === "ALL" && request('brandId') && request('styleId'))
        {
            return $query->where([
                ['stock_status', 'DISPLAY'],
                ['apparelcatalogs.brand_id', request('brandId')],
                ['apparelcatalogs.style_id', request('styleId')]
            ]);
        }
        elseif(request('brandId') === NULL && request('styleId') && request('category'))
        {   
            return $query->where([
                ['stock_status', 'DISPLAY'],
                ['category', request('category')],
                ['apparelcatalogs.style_id', request('styleId')]
            ]);
        }
        elseif(request('promo') === "ON SALE")
        {
            return $query->where('stock_status', 'DISPLAY')
                ->whereNotNull('before_price');
        }
        else
        {
            return $query->where('stock_status', 'DISPLAY');
        }
    }

    // public function scopeStockWhereSearchKeyword($query, $request)
    // {   
    //     $keyword = request('search');

    //     if($keyword)
    //     {
    //         return $query->where([
    //             [function ($query) use ($keyword){
    //                     $query->where('brand_name', 'LIKE', '%' . $keyword . '%')
    //                         ->orWhere('style', 'LIKE', '%' . $keyword . '%')
    //                         ->orWhere('category', 'LIKE', '%' . $keyword . '%')
    //                         ->orWhere('description', 'LIKE', '%' . $keyword . '%')
    //                         ->orWhere('serial_number', 'LIKE', '%' . $keyword . '%')
    //                         ->orWhere('stocklists.id', $keyword);
    //             }],
    //             ['stock_status', 'DISPLAY']
    //         ]);
    //     }
    //     elseif(request('brand') && request('style') && request('category') === NULL)
    //     {   
    //         return $query->where([
    //                 ['stock_status', 'DISPLAY'],
    //                 ['brand_name', request('brand')],
    //                 ['style', request('style')]
    //             ]);
    //     }
    //     elseif(request('brand') && request('style') && request('category'))
    //     {   
    //         return $query->where([
    //             ['stock_status', 'DISPLAY'],
    //             ['category', request('category')],
    //             ['brand_name', request('brand')],
    //             ['style', request('style')]
    //         ]);
    //     }
    //     elseif(request('brand') === NULL && request('style') && request('category'))
    //     {   
    //         return $query->where([
    //             ['stock_status', 'DISPLAY'],
    //             ['category', request('category')],
    //             ['style', request('style')]
    //         ]);
    //     }
    //     elseif(request('promo') === "ON SALE")
    //     {
    //         return $query->where('stock_status', 'DISPLAY')
    //             ->whereNotNull('before_price');
    //     }
    //     elseif(request('promo') === "NEWLY DISPLAYED")
    //     {
    //         return $query->where('stock_status', 'DISPLAY');
    //     }
    //     else
    //     {
    //         return $query->where('stock_status', 'DISPLAY');
    //     }
    // }

    public function scopeStockBetweenMinAndMax($query, $request)
    {
        return $query->whereBetween('tag_price', [request('minPrice'),request('maxPrice')]);
    }

    public function scopeStockColor($query, $request)
    {
        if(request('color') === 'ALL')
        {
            return $query->whereNotNull('color');
        }
        else
        {
            return $query->where('color', request('color'));
        }
    }

    public function scopeStockSize($query, $request)
    {
        if(request('size') === 'ALL')
        {
            return $query->whereNotNull('size');
        }
        else
        {
            return $query->where('size', request('size'));
        }
    }

    public function scopeStockGet($query, $request)
    {   
        if(request('sorting') == 'HIGHEST')
        {
            return $query->orderBy('photos.created_at', 'DESC')
            ->get()
            ->unique('id')
            ->sortBy([['tag_price', 'desc']])
            ->chunk(12)
            ->values()
            ->all();
        }
        elseif(request('sorting') == 'LOWEST')
        {
            return $query->orderBy('photos.created_at', 'DESC')
            ->get()
            ->unique('id')
            ->sortBy([['tag_price', 'asc']])
            ->chunk(12)
            ->values()
            ->all();
        }
        else
        {
            return $query->orderBy('photos.created_at', 'DESC')
            ->get()
            ->unique('id')
            ->sortBy([['id', 'desc']])
            ->chunk(12)
            ->values()
            ->all();
        }
    }

    public function scopeStockGetUnique($query)
    {
        return $query->orderBy('photos.created_at', 'DESC')
            ->get()
            ->unique('id');
    }

    public function scopeStockGetUniqueColor($query)
    {
        return $query->orderBy('photos.created_at', 'DESC')
            ->get()
            ->unique('color');
    }
}