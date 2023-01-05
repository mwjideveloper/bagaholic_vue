<?php

namespace App\Traits\ControllerQueries;

trait CatalogQuery
{
    public function allCatalogs($modelApparel, $modelWatch, $modelBrand, $modelStyle, $keyword, $category)
    {   
        $brandId = $modelBrand::where('brand_name','LIKE', '%'.$keyword.'%')->value('id');
        $styleId = $modelStyle::where('style','LIKE', '%'.$keyword.'%')->value('id');

        if ($category === "WATCH") {
            return $modelWatch::WatchKeyword($keyword, $category, $brandId)
                ->CatalogStatusSearchable('catalog_status')->paginate(12)->withQueryString();
        } else {
            return $modelApparel::ApparelKeyword($keyword, $category, $brandId, $styleId)
                ->CatalogStatusSearchable('catalog_status')->paginate(12)->withQueryString();
        }
    }

    public function findCatalogRow($modelApparel, $modelWatch, $category, $catalogId)
    {
        if ($category === "WATCH") {
            return $modelWatch::find($catalogId);
        } else {
            return $modelApparel::find($catalogId);
        }
    }

    public function catalogType($category)
    {
        if ($category === "WATCH") {
            return 'App\Watchcatalog';
        } else {
            return 'App\Apparelcatalog';
        }
    }
}