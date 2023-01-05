<?php

namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\Style;
use DB;
 
class StyleController extends Controller
{
    // all styles
    public function index($id)
    {                          
        $styles = Style::leftJoin('photos', function ($join) {
                                $join->on('photos.imageable_id', '=', 'styles.id')
                                    ->where('photos.imageable_type', 'App\Style')
                                    ->where('photos.id', '=', DB::raw("(select max(id) from photos WHERE photos.imageable_id = styles.id && photos.position = 'MAIN IMAGE')"));
                            })
                    ->join('apparelcatalogs', 'styles.id', '=', 'apparelcatalogs.style_id')
                    ->join('brands', function ($join) use ($id) {
                                $join->on('brands.id', '=', 'apparelcatalogs.brand_id')
                                    ->where('brands.id', $id);
                            })
                    ->leftJoin('stocklists', function ($join) {
                                $join->on('stocklists.catalogable_id', '=', 'apparelcatalogs.id')
                                    ->where('stocklists.stock_status', 'DISPLAY');
                            })
                    ->select('style_id','style','path','stock_status','brand_id','brand_name')
                    ->get()->unique('style_id')->chunk(2);

        return response()->json($styles);
    }

    public function styleName($id)
    {
        $styleName = Style::where('id', $id)->get()->value('style');

        return response()->json($styleName);
    }
}