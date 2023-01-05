<?php

namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
 
use App\Models\Branch;
 
class BranchController extends Controller
{
    // all brands
    public function index()
    {
        $branches = Branch::where('id', '!=', 1)->orderBy('id', 'DESC')->get();

        return response()->json($branches);
    }
}