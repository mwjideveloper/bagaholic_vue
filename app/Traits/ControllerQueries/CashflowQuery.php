<?php

namespace App\Traits\ControllerQueries;

trait CashflowQuery
{
    public function totalCashOfTheDay($collectionTotalCashMoneyIn, $collectionTotalCashMoneyOut)
    {   
        $totalCashMoneyIn = 0;
        $totalCashMoneyOut = 0;

        foreach ($collectionTotalCashMoneyIn as $p) 
        {
            $eachMoneyIn = $p->money_in;
            $totalCashMoneyIn = $totalCashMoneyIn + $eachMoneyIn;
        }

        foreach ($collectionTotalCashMoneyOut as $y) 
        {
            $eachMoneyOut = $y->money_out;
            $totalCashMoneyOut = $totalCashMoneyOut + $eachMoneyOut;
        }

        return [$totalCashMoneyIn, $totalCashMoneyOut];
    }

    public function totalDailyCashOfTheDay($collectionTotalDailyCashMoneyIn, $collectionTotalDailyCashMoneyOut)
    {   
        $totalDailyCashMoneyIn = 0;
        $totalDailyCashMoneyOut = 0;

        foreach ($collectionTotalDailyCashMoneyIn as $p) 
        {
            $eachMoneyIn = $p->money_in;
            $totalDailyCashMoneyIn = $totalDailyCashMoneyIn + $eachMoneyIn;
        }

        foreach ($collectionTotalDailyCashMoneyOut as $y) 
        {
            $eachMoneyOut = $y->money_out;
            $totalDailyCashMoneyOut = $totalDailyCashMoneyOut + $eachMoneyOut;
        }

        return [$totalDailyCashMoneyIn, $totalDailyCashMoneyOut];
    }

    public function totalBankAssetOfTheDay($collectionTotalBankAssetMoneyIn, $collectionTotalBankAssetMoneyOut)
    {   
        $totalBankAssetMoneyIn = 0;
        $totalBankAssetMoneyOut = 0;

        foreach ($collectionTotalBankAssetMoneyIn as $p) 
        {
            $eachMoneyIn = $p->money_in;
            $totalBankAssetMoneyIn = $totalBankAssetMoneyIn + $eachMoneyIn;
        }

        foreach ($collectionTotalBankAssetMoneyOut as $y) 
        {
            $eachMoneyOut = $y->money_out;
            $totalBankAssetMoneyOut = $totalBankAssetMoneyOut + $eachMoneyOut;
        }

        return [$totalBankAssetMoneyIn, $totalBankAssetMoneyOut];
    }

    public function totalDailyBankAssetOfTheDay($collectionTotalDailyBankAssetMoneyIn, $collectionTotalDailyBankAssetMoneyOut)
    {   
        $totalDailyBankAssetMoneyIn = 0;
        $totalDailyBankAssetMoneyOut = 0;

        foreach ($collectionTotalDailyBankAssetMoneyIn as $p) 
        {
            $eachMoneyIn = $p->money_in;
            $totalDailyBankAssetMoneyIn = $totalDailyBankAssetMoneyIn + $eachMoneyIn;
        }

        foreach ($collectionTotalDailyBankAssetMoneyOut as $y) 
        {
            $eachMoneyOut = $y->money_out;
            $totalDailyBankAssetMoneyOut = $totalDailyBankAssetMoneyOut + $eachMoneyOut;
        }

        return [$totalDailyBankAssetMoneyIn, $totalDailyBankAssetMoneyOut];
    }

    public function totalCollectiblesOfTheDay($collectionTotalCollectibleMoneyIn, $collectionTotalCollectibleMoneyOut)
    {   
        $totalCollectibleMoneyIn = 0;
        $totalCollectibleMoneyOut = 0;

        foreach ($collectionTotalCollectibleMoneyIn as $p) 
        {
            $eachMoneyIn = $p->money_in;

            if($p->payment_option === 'BALANCE')
            {
                $eachMoneyIn = $p->monthly_interest;
            }

            $totalCollectibleMoneyIn = $totalCollectibleMoneyIn + $eachMoneyIn;
        }

        foreach ($collectionTotalCollectibleMoneyOut as $y) 
        {
            $eachMoneyOut = $y->money_out;

            if($p->payment_option === 'BALANCE')
            {
                $eachMoneyIn = $p->monthly_interest;
            }

            $totalCollectibleMoneyOut = $totalCollectibleMoneyOut + $eachMoneyOut;
        }

        return [$totalCollectibleMoneyIn, $totalCollectibleMoneyOut];
    }

    public function totalDailyCollectiblesOfTheDay($collectionTotalDailyCollectibleMoneyIn, $collectionTotalDailyCollectibleMoneyOut)
    {   
        $totalDailyCollectibleMoneyIn = 0;
        $totalDailyCollectibleMoneyOut = 0;

        foreach ($collectionTotalDailyCollectibleMoneyIn as $p) 
        {
            $eachMoneyIn = $p->money_in;

            if($p->payment_option === 'BALANCE')
            {
                $eachMoneyIn = $p->monthly_interest;
            }

            $totalDailyCollectibleMoneyIn = $totalDailyCollectibleMoneyIn + $eachMoneyIn;
        }

        foreach ($collectionTotalDailyCollectibleMoneyOut as $y) 
        {
            $eachMoneyOut = $y->money_out;

            if($p->payment_option === 'BALANCE')
            {
                $eachMoneyIn = $p->monthly_interest;
            }

            $totalDailyCollectibleMoneyOut = $totalDailyCollectibleMoneyOut + $eachMoneyOut;
        }

        return [$totalDailyCollectibleMoneyIn, $totalDailyCollectibleMoneyOut];
    }

    //MONEY-IN TOTAL IN SPECIFICS
    public function totalProfitTagMinimumCost($collection) 
    {
        $totalProfit = 0;
        $totalTag = 0;
        $totalMinimum = 0;
        $totalCost = 0;

        if(isset($collection[0]))
        {
            foreach ($collection as $item) 
            {   
                if($item['accumulated_down_payment'])
                {
                    $eachItemProfit = $item['money_in'] + $item['accumulated_down_payment'] - $item['current_principal'];
                }
                else
                {
                    $eachItemProfit = $item['money_in'] - $item['current_principal'];
                }
                
                $eachItemTag = $item['tag_price'];
                $eachItemMinimum = $item['minimum_price'];
                $eachItemCost = $item['current_principal'];
    
                $totalProfit += $eachItemProfit;
                $totalTag += $eachItemTag;
                $totalMinimum += $eachItemMinimum;
                $totalCost += $eachItemCost;
            }
        }
        

        return [$totalProfit, $totalTag, $totalMinimum, $totalCost];
    }


    //TOTAL EACH SPECIFICS
    public function totalSpecificMoneyIn($collection)
    {
        $totalSpecificMoneyIn = 0;

        foreach ($collection as $singular) 
        {
            $each = $singular->money_in;

            if($singular->payment_option === 'BALANCE')
            {
                $each = $singular->monthly_interest;
            }

            $totalSpecificMoneyIn = $totalSpecificMoneyIn + $each;
        }

        return $totalSpecificMoneyIn;
    }

    public function totalSpecificMoneyOut($collection)
    {
        $totalSpecificMoneyOut = 0;

        foreach ($collection as $singular) 
        {
            $each = $singular->money_out;

            if($singular->payment_option === 'BALANCE')
            {
                $each = $singular->monthly_interest;
            }

            $totalSpecificMoneyOut = $totalSpecificMoneyOut + $each;
        }

        return $totalSpecificMoneyOut;
    }

    public function totalSpecificMoneyInAndOut($collection, $transaction_type)
    {   
        if($transaction_type === 'BUYING' || $transaction_type === 'PAWNING' || $transaction_type === 'MONEY OUT')
        {
            $totalSpecificMoneyOut = 0;

            foreach ($collection as $singular) 
            {
                $each = $singular->money_out;

                if($singular->payment_option === 'BALANCE')
                {
                    $each = $singular->monthly_interest;
                }

                $totalSpecificMoneyOut = $totalSpecificMoneyOut + $each;
            }

            return $totalSpecificMoneyOut;
        }
        else
        {
            $totalSpecificMoneyIn = 0;

            foreach ($collection as $singular) 
            {
                $each = $singular->money_in;

                if($singular->payment_option === 'BALANCE')
                {
                    $each = $singular->monthly_interest;
                }

                $totalSpecificMoneyIn = $totalSpecificMoneyIn + $each;
            }

            return $totalSpecificMoneyIn;
        }  
    }


    //IDENTIFYING THE DATES
    public function properInputDate($year, $month, $day)
    {   
        if ($month > 12)
        {
            return 'PLEASE CHECK THE PROPER MONTH';
        } 
        elseif($day && !checkdate($month,$day,$year)) 
        {
            return 'PLEASE CHECK THE PROPER DAY';
        }
    }

    public function dateYearMonthDayError($firstTransaction, $lastTransaction, $year, $month, $day)
    {
        if ($firstTransaction->year > (int)$year)
        {
            return 'NO PAST INFORMATION.';
        }
        elseif ($firstTransaction->year === (int)$year && $firstTransaction->month > (int)$month)
        {
            return 'NO PAST INFORMATION.';
        } 
        elseif ($firstTransaction->year === (int)$year && $firstTransaction->month === (int)$month && $firstTransaction->day > (int)$day) 
        {
            return 'NO PAST INFORMATION.';
        }
        elseif ($lastTransaction->year < (int)$year) 
        {
            return 'NO FUTURE INFORMATION.';
        } 
        elseif ($lastTransaction->year === (int)$year && $lastTransaction->month < (int)$month) 
        {
            return 'NO FUTURE INFORMATION.';
        } 
        elseif ($lastTransaction->year === (int)$year && $lastTransaction->month === (int)$month && $lastTransaction->day < (int)$day) 
        {
            return 'NO FUTURE INFORMATION.';
        }
    }

    public function dateYearMonthError($firstTransaction, $lastTransaction, $year, $month)
    {
        if ($firstTransaction->year > (int)$year) 
        {
            return 'NO INPUTS IN THE PAST.';
        } 
        elseif ($firstTransaction->year === (int)$year && $firstTransaction->month > (int)$month) 
        {
            return 'NO INPUTS IN THE PAST.';
        } 
        elseif ($lastTransaction->year < (int)$year) 
        {
            return 'NO INPUTS IN THE FUTURE.';
        } 
        elseif ($lastTransaction->year === (int)$year && $lastTransaction->month < (int)$month) 
        {
            return 'NO INPUTS IN THE FUTURE.';
        }
    }

    public function dateYearError($firstTransaction, $lastTransaction, $year)
    {
        if($firstTransaction->year > (int)$year){
            return 'NO INPUTS IN THE PAST YEAR';
        } elseif ($lastTransaction->year < (int)$year) {
            return 'NO INPUTS IN THE FUTURE YEAR';
        }
    }

}