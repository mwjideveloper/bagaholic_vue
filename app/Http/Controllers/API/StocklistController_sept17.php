<?php

namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
 
use App\Models\Stocklist;
 
use Illuminate\Http\Request;
 
use Validator;
 
class StocklistController extends Controller
{
    // all stocks from the newest
    public function index()
    {
        $stocklists = Stocklist::StockRelatedTables()->where('stock_status', 'DISPLAY')->StockSelectedFields()->orderBy('stocklists.created_at','desc')->take('21')->get()->toArray();
        return array_reverse($stocklists);
    }

    // Stocks based on category, brand, and style
    public function shop_menu(Request $request)
    {
        $stocklists = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockGet($request);

        return response()->json($stocklists);
    }

    // COUNT STOCKS
    public function count(Request $request)
    {
        $countStocks = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockGetUnique()->count();

        return response()->json($countStocks);
    }

    public function paginate_index(Request $request)
    {
        $array = [request('counter')];

        return response()->json($array);
    }

    // Individual Stock
    public function view($stockId)
    {
        $stock = Stocklist::where([['stocklists.id', $stockId],['stock_status', 'DISPLAY']])
                    ->IndividualStockRelatedTables()
                    ->IndividualStockSelectedFields()
                    ->get()
                    ->unique('position');

        return response()->json($stock);
    }

    public function sorting_by(Request $request)
    {
        $sorting_by = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockBetweenMinAndMax($request)->StockGet($request);

        return response()->json($sorting_by);
    }
    
    public function sorting_price(Request $request)
    {
        $sorting_price = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockBetweenMinAndMax($request)->StockGet($request);

        return response()->json($sorting_price);
    }

    public function sorting_update_count(Request $request)
    {
        $sorting_count = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockBetweenMinAndMax($request)->StockColor($request)->StockGetUnique()->count();

        return response()->json($sorting_count);
    }

    public function sorting_ajax(Request $request)
    {
        $sorting_ajax = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockBetweenMinAndMax($request)->StockColor($request)->StockGet($request);

        return response()->json($sorting_ajax);
    }

    public function min_price(Request $request)
    {
        $min_price = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockGetUnique()->min('tag_price');

        return response()->json($min_price);
    }

    public function max_price(Request $request)
    {
        $max_price = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockGetUnique()->max('tag_price');

        return response()->json($max_price);
    }

    public function color_list(Request $request)
    {
        $colorList = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockGetUnique()->sortBy('color')->unique('color')->pluck('color');

        return response()->json($colorList);
    }

    public function size_list(Request $request)
    {
        $sizeList = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockGetUnique()->sortBy('size')->unique('size')->pluck('size');

        return response()->json($sizeList);
    }
}