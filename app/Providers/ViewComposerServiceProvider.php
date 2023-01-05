<?php

namespace App\Providers;
use App\Models\Brand;
use App\Models\Stocklist;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{   
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composerAppLayout();
    }

    private function composerAppLayout()
    {   
        view()->composer(['layouts.app'], function ($view) {
            $allBrands = Brand::whereIn('brand_type', ['APPAREL','MIXED'])->orderBy('brand_name', 'ASC')->select('id', 'brand_name', 'brand_type')->get();

            $allStyles = array();
            $categories = ['ACCESSORY','EYEWEAR','FOOTWEAR','WALLET'];
            foreach($categories as $categoryKey){
                $allStylesByCategory = Stocklist::join('apparelcatalogs', function ($join) {
                            $join->on('stocklists.catalogable_id', '=', 'apparelcatalogs.id')
                                ->where([
                                    ['stocklists.catalogable_type', 'App\Apparelcatalog'],
                                    ['stocklists.stock_status', 'DISPLAY']
                                ]);
                        })
                        ->join('styles', 'styles.id', '=', 'apparelcatalogs.style_id')
                        ->join('brands', 'brands.id', '=', 'apparelcatalogs.brand_id')
                        ->where('category', $categoryKey)
                        ->distinct('style')
                        ->select('styles.id','style','category')
                        ->get();

                array_push($allStyles, $allStylesByCategory);
            }

            $allStylesListBrands = array();
            foreach($allBrands as $brandKey){
                $allStylesByBagWithBrand = Stocklist::leftJoin('apparelcatalogs', function ($join) {
                            $join->on('stocklists.catalogable_id', '=', 'apparelcatalogs.id')
                                ->where([
                                    ['stocklists.catalogable_type', 'App\Apparelcatalog'],
                                    ['stocklists.stock_status', 'DISPLAY']
                                ]);
                        })
                        ->leftjoin('styles', 'styles.id', '=', 'apparelcatalogs.style_id')
                        ->leftjoin('brands', 'brands.id', '=', 'apparelcatalogs.brand_id')
                        ->where([
                            ['category', 'BAG'],
                            ['brand_name', $brandKey->brand_name]
                        ])
                        ->select('styles.id','style','category','brand_name')
                        ->distinct('style')
                        ->get();
                        
                array_push($allStylesListBrands, $allStylesByBagWithBrand);
            }

            return $view->with(compact('allBrands','allStyles','allStylesListBrands'));
        });
    }
}
