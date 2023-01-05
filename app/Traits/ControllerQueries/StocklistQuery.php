<?php

namespace App\Traits\ControllerQueries;

trait StocklistQuery
{
    public function pricingNumber($stockRow)
    {   
        if($stockRow)
        {
            if ($stockRow->current_principal || $stockRow->minimum_price)
            {
                $costPrice = $stockRow->current_principal;
                $costThousands = $costPrice % 1000000;
                $costMillions = ($costPrice - $costThousands)/1000000;
                $costThousands = $costThousands / 1000;
                
                $minPrice = $stockRow->minimum_price;
                $minThousands = $minPrice % 1000000;
                $minMillions = ($minPrice - $minThousands)/1000000;
                $minThousands = $minThousands / 1000;
            
                return  "DC" . $costMillions
                        ."." . $costThousands
                        ."LO YX" . $minMillions
                        ."." .$minThousands
                        ."LM WT" . $stockRow->apparel_catalog_id . $stockRow->watch_catalog_id . "ON";
            } 
            else 
            {
                return back();
            }
        }
        else
        {
            return back();
        }
    }

    public function showItemDisplayWithinBranch($model, $keyword, $branchId)
    {
        return $model::where([
            ['id', $keyword],
            ['stock_status', 'DISPLAY'],
            ['branch_id', $branchId]
        ])->first();
    }

    public function searchStockForPricing($model, $stockId, $branchId)
    {
        return $model::where([
                        ['id', $stockId],
                        ['branch_id', $branchId]
                    ])
                    ->whereIn('stock_status', ['FOR PRICING'])
                    ->first();
    }

    public function identifyRepairId($repairContactId)
    {
        if($repairContactId)
        {
            return $repairContactId;
        } 
        else
        {
            return 1;
        }
    }

    public function identifyRepairOrStockStatus($stockStatus)
    {
        if ($stockStatus === "FOR REPAIR")
        {
            return ["FOR PICK-UP", "SENDING REPAIR"];
        } 
        else 
        {
            return [$stockStatus, $stockStatus];
        }
    }
}