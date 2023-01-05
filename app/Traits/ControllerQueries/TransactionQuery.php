<?php

namespace App\Traits\ControllerQueries;

trait TransactionQuery
{
    public function dayDate($day)
    {   
        if($day === '1' || $day === '21' || $day === '31'){
            return $day . 'st';
        } elseif($day === '2' || $day === '22') {
            return $day . 'nd';
        } elseif($day === '3' || $day === '23') {
            return $day . 'rd';
        } else {
            return $day . 'th';
        }
    }

    public function accumulatedDownpayment($transactionRows)
    {
        $accumulatedDownpayment = 0;

        foreach($transactionRows as $transactionRow){
            $accumulatedDownpayment += $transactionRow->money_in;
        }

        return $accumulatedDownpayment;
    }

    public function identifyTransactionType($status)
    {
        if($status === "FULL PAYMENT")
        {
            return "SELLING";
        }
        else
        {
            return "OTC RESERVATION";
        }
    }
}