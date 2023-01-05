<?php

namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\Brand;
 
class BrandController extends Controller
{
    // all brands
    public function index()
    {
        $brands = Brand::FindBrandsWithStocksWithImage()->where('stock_status','DISPLAY')->whereIn('brand_type', ['APPAREL','MIXED'])->select('brands.*','photos.path')->get()->unique('brand_name')->chunk(2);

        return response()->json($brands);
    }

    public function find($id)
    {
        $brand = Brand::where('id',$id)->first();

        return response()->json($brand);
    }

    public function brandName($id)
    {
        $brand = Brand::where('id', $id)->get()->value('brand_name');

        return response()->json($brand);
    }
}