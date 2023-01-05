<?php

namespace App\Traits\ControllerQueries;

trait BranchQuery
{
    public function identifyBranch($branchId)
    {   
        if($branchId === 2) {
            return "M.W.E.";
        } elseif($branchId === 3) {
            return "BAGAHOLIC";
        }
    }
}