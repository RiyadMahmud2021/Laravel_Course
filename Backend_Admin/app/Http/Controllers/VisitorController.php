<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    public function visitorIndex(){

        $vistorData = VisitorModel::get(); // catch all data
        // $vistorData = VisitorModel::orderBy('id', 'desc')->get(); // descending data
        // $vistorData = VisitorModel::orderBy('id','DESC') -> take(10) -> get(); // catch data with limit
        
        // dd($vistorData);
        return view('visitor', compact('vistorData'));
        
    }
}
