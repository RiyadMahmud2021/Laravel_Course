<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    public function visitorIndex(){
        try {
            $vistorData = VisitorModel::get(); // catch all data
            // $vistorData = VisitorModel::orderBy('id', 'desc')->get(); // descending data
            // $vistorData = VisitorModel::orderBy('id','DESC') -> take(10) -> get(); // catch data with limit
            
            // dd($vistorData);
          
        }catch (\Exception $e) {
            return view('error');
            // return view('error', compact('e'));
        }

        return view('visitor', compact('vistorData'));
        
    }
}
