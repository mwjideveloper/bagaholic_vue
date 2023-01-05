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

    public function sorting_update_count(Request $request)
    {
        $sorting_count = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockBetweenMinAndMax($request)->StockColor($request)->StockSize($request)->StockGetUnique()->count();

        return response()->json($sorting_count);
    }

    public function sorting_ajax(Request $request)
    {
        $sorting_ajax = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockBetweenMinAndMax($request)->StockColor($request)->StockSize($request)->StockGet($request);

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
        $sizeList = Stocklist::StockRelatedTables()->StockWhereSearchKeyword($request)->StockSelectedFields()->StockGetUnique()->sortBy('size')->unique('size')->pluck('size')->filter()->all();;

        return response()->json($sizeList);
    }

    // Individual Stock
    public function find_stock($stockId)
    {
        return Stocklist::where([['stocklists.id', $stockId],['stock_status', 'DISPLAY']])
                    ->IndividualStockRelatedTables()
                    ->IndividualStockSelectedFields()
                    ->get()
                    ->unique('position');
    }

    public function view($stockId)
    {
        $stock = $this->find_stock($stockId);

        return response()->json($stock);
    }

    public function related_stocks_to_view($stockId)
    {   
        $stockId = $this->find_stock($stockId)->value('id');
        $brand_name = $this->find_stock($stockId)->value('brand_name');
        $style = $this->find_stock($stockId)->value('style');

        $stocksWithSimilarStyle = Stocklist::StockRelatedTables()
                                    ->where([
                                        ['stock_status', 'DISPLAY'],
                                        ['stocklists.id','!=', $stockId],
                                        ['brand_name', $brand_name],
                                        ['style', $style]
                                    ])
                                    ->StockSelectedFields()
                                    ->orderBy('stocklists.created_at','desc')
                                    ->take('15')
                                    ->get();
        
        $stocksWithSimilarBrand = Stocklist::StockRelatedTables()
                                    ->where([
                                        ['stock_status', 'DISPLAY'],
                                        ['stocklists.id','!=', $stockId],
                                        ['brand_name', $brand_name],
                                        ['style', $style]
                                    ])
                                    ->StockSelectedFields()
                                    ->inRandomOrder()
                                    ->take('15')
                                    ->get();
        
        $stocksWithDisplay = Stocklist::StockRelatedTables()
                                    ->where([
                                        ['stock_status', 'DISPLAY'],
                                        ['stocklists.id','!=', $stockId]
                                    ])
                                    ->StockSelectedFields()
                                    ->inRandomOrder()
                                    ->take('15')
                                    ->get();
                                        
        $allStocks = $stocksWithSimilarStyle->merge($stocksWithSimilarBrand)->merge($stocksWithDisplay)->take(12);

        return response()->json($allStocks);
    }
}