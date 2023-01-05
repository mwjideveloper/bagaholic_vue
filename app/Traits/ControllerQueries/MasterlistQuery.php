<?php

namespace App\Traits\ControllerQueries;

trait MasterlistQuery
{
    public function calculateProfit($transaction, $stock)
    {   
        if($transaction) {
			return $transaction->money_in - $stock->currentPrincipal;
		} else {
			return NULL;
		}
    }

    public function totalCalculations($stockListQuery)
    {   
        $totalCost = NULL;
    	$totalMinimum = NULL;
    	$totalTag = NULL;
		$totalBefore = NULL;
    	$totalMoneyIn = NULL;
    	$totalMoneyOut = NULL;
    	$totalProfit = NULL;


	    foreach ($stockListQuery as $item) {
			$each_item_cost = $item['current_principal'];
	        $each_item__minimum = $item['minimum_price'];
	        $each_item_tag = $item['tag_price'];
			$each_item_before = $item['before_price'];
	        $each_item_money_in = $item['money_in'];
	        $each_item_money_out = $item['money_out'];
			$each_item_profit = $item['profit'];

			$totalCost += $each_item_cost;
	        $totalMinimum += $each_item__minimum;
		    $totalTag += $each_item_tag;
			$totalBefore += $each_item_before;
		    $totalMoneyIn += $each_item_money_in;
		    $totalMoneyOut += $each_item_money_out;
		    $totalProfit += $each_item_profit;
	    }

        return [$totalCost, $totalMinimum, $totalTag, $totalBefore, $totalMoneyIn, $totalMoneyOut, $totalProfit];
    }

	public function identifyStockListQuery($model, $category, $list, $branchId)
	{
			if ($category === 'WATCH')
			{
    			//WATCH CATALOG STOCK LIST
    			if ($list === "ALL")
				{	
					//ALL WATCHES
				    $stockListQuery = $model::AllWatchStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldAllandSoldWatch()->get();
				    $stockListQueryOrderDescriptionCost = $model::AllWatchStocklist($category, $branchId)->OrderByCostWatch()->SelectFieldAllandSoldWatch()->get();
				    $stockListQueryOrderDescriptionStockID = $model::AllWatchStocklist($category, $branchId)->OrderByStockIdWatch()->SelectFieldAllandSoldWatch()->get();
				}
				else if ($list === "SOLD") 
				{
				    //SOLD wATCHES
				    $stockListQuery = $model::SoldWatchStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldAllandSoldWatch()->get();
				    $stockListQueryOrderDescriptionCost = $model::SoldWatchStocklist($category, $branchId)->OrderByCostWatch()->SelectFieldAllandSoldWatch()->get();
				    $stockListQueryOrderDescriptionStockID = $model::SoldWatchStocklist($category, $branchId)->OrderByStockIdWatch()->SelectFieldAllandSoldWatch()->get();
				} 
				else if ($list === "DISPLAYED") 
				{
					//DISPLAYED WATCHES
				    $stockListQuery = $model::DisplayedWatchStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldDisplayReservedandOthersWatch()->get();
				    $stockListQueryOrderDescriptionCost = $model::DisplayedWatchStocklist($category, $branchId)->OrderByCostWatch()->SelectFieldDisplayReservedandOthersWatch()->get();
				    $stockListQueryOrderDescriptionStockID = $model::DisplayedWatchStocklist($category, $branchId)->OrderByStockIdWatch()->SelectFieldDisplayReservedandOthersWatch()->get();
				} 
				else if ($list === "RESERVED") 
				{
					//RESERVED WATCHES
					$stockListQuery = $model::ReservedWatchStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldDisplayReservedandOthersWatch()->get();
					$stockListQueryOrderDescriptionCost = $model::ReservedWatchStocklist($category, $branchId)->OrderByCostWatch()->SelectFieldDisplayReservedandOthersWatch()->get();
					$stockListQueryOrderDescriptionStockID = $model::ReservedWatchStocklist($category, $branchId)->OrderByStockIdWatch()->SelectFieldDisplayReservedandOthersWatch()->get();
				} 
				else 
				{
					//OTHERS WATCHES
				    $stockListQuery = $model::OthersWatchStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldDisplayReservedandOthersWatch()->get();
				    $stockListQueryOrderDescriptionCost = $model::OthersWatchStocklist($category, $branchId)->OrderByCostWatch()->SelectFieldDisplayReservedandOthersWatch()->get();
				    $stockListQueryOrderDescriptionStockID = $model::OthersWatchStocklist($category, $branchId)->OrderByStockIdWatch()->SelectFieldDisplayReservedandOthersWatch()->get();
				}
    		} 
			else 
			{
    			//PRODUCT CATALOG STOCK LIST
    		    if ($list === "ALL")
				{
					//ALL APPAREL
			    	$stockListQuery = $model::AllApparelStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldAllandSold()->get();
				    $stockListQueryOrderDescriptionCost = $model::AllApparelStocklist($category, $branchId)->OrderByCost()->SelectFieldAllandSold()->get();
				    $stockListQueryOrderDescriptionStockID = $model::AllApparelStocklist($category, $branchId)->OrderByStockId()->SelectFieldAllandSold()->get();
			    } 
				else if ($list === "SOLD") 
				{	
					//SOLD APPAREL
			    	$stockListQuery = $model::scopeSoldApparelStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldAllandSold()->get();
				    $stockListQueryOrderDescriptionCost = $model::scopeSoldApparelStocklist($category, $branchId)->OrderByCost()->SelectFieldAllandSold()->get();
				    $stockListQueryOrderDescriptionStockID = $model::scopeSoldApparelStocklist($category, $branchId)->OrderByStockId()->SelectFieldAllandSold()->get();
			    } 
				else if ($list === "DISPLAYED") 
				{	
					//DISPLAYED APPAREL
			    	$stockListQuery = $model::DisplayedApparelStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldDisplayReservedandOthers()->get();
				    $stockListQueryOrderDescriptionCost = $model::DisplayedApparelStocklist($category, $branchId)->OrderByCost()->SelectFieldDisplayReservedandOthers()->get();
				    $stockListQueryOrderDescriptionStockID = $model::DisplayedApparelStocklist($category, $branchId)->OrderByStockId()->SelectFieldDisplayReservedandOthers()->get();
			    } 
				else if ($list === "RESERVED") 
				{	
					//RESERVED APPAREL
			    	$stockListQuery = $model::ReservedApparelStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldDisplayReservedandOthers()->get();
					$stockListQueryOrderDescriptionCost = $model::ReservedApparelStocklist($category, $branchId)->OrderByCost()->SelectFieldDisplayReservedandOthers()->get();
					$stockListQueryOrderDescriptionStockID = $model::ReservedApparelStocklist($category, $branchId)->OrderByStockId()->SelectFieldDisplayReservedandOthers()->get();
				} 
				else 
				{	
					//OTHERS APPAREL
			    	$stockListQuery = $model::OthersApparelStocklist($category, $branchId)->OrderByCreatedAt()->SelectFieldDisplayReservedandOthers()->get();
				    $stockListQueryOrderDescriptionCost = $model::OthersApparelStocklist($category, $branchId)->OrderByCost()->SelectFieldDisplayReservedandOthers()->get();
				    $stockListQueryOrderDescriptionStockID = $model::OthersApparelStocklist($category, $branchId)->OrderByStockId()->SelectFieldDisplayReservedandOthers()->get();
			    }				
    		}

			return [$stockListQuery, $stockListQueryOrderDescriptionCost, $stockListQueryOrderDescriptionStockID];
	}
}