<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('stocks', 'StocklistController@index');

Route::group(['prefix' => 'stocks'], function () {

    //INDIVIDUAL VIEWING OF STOCK
    Route::get('view/{stockId}', 'StocklistController@view');
    Route::get('view/related_stocks/{stockId}', 'StocklistController@related_stocks_to_view');

    //SHOP MENU
    Route::post('shop', 'StocklistController@shop_menu');
    Route::post('count', 'StocklistController@count');
    Route::post('paginate-index', 'StocklistController@paginate_index');
    Route::get('brand/{id}', 'BrandController@brandName');
    Route::get('style/{id}', 'StyleController@styleName');

    //AJAX SORTINGS
    Route::post('sorting/by', 'StocklistController@sorting_by');
    Route::post('sorting/price', 'StocklistController@sorting_price');
    Route::post('sorting/update_count', 'StocklistController@sorting_update_count');
    Route::post('sorting/ajax', 'StocklistController@sorting_ajax');

    //MIN AND MAX PRICE
    Route::post('minPrice', 'StocklistController@min_price');
    Route::post('maxPrice', 'StocklistController@max_price');

    //SIZE AND COLOR LIST
    Route::post('colorlist', 'StocklistController@color_list');
    Route::post('sizelist', 'StocklistController@size_list');
});

//SIDE MENU
Route::get('allbrands', 'SidemenuController@index');

// BRAND AND STYLE
Route::get('stocks/brands', 'BrandController@index');
Route::get('specific_brand/{id}', 'BrandController@find');
Route::get('brand_and_style/{id}', 'StyleController@index');



//CONTACT US
Route::get('branches', 'BranchController@index');
