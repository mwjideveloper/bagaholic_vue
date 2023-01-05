<?php

namespace App\Traits\ControllerQueries;

trait ContactdetailQuery
{
    public function identifyRepairOrContact($contactId)
    {   
        if($contactId){
            return $contactId;
        } else {
            return 1;
        }
    }
}