<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceModel;

class ServiceController extends Controller
{
    public function serviceIndex(){

        return view('services');
        
    }

    public function getServiceData(){

        $result = ServiceModel::orderBy('id','desc')->get();
        // dd($result);
        return $result;
        
    }

    public function deleteServices(Request $req){

        $deleteId = $req->input('id');
        $result = ServiceModel::where('id', '=', $deleteId)->delete();
        // // dd($result);
        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
        
    }

    public function detailEachServices(Request $req){

        $detailId = $req->input('id');

        $result = ServiceModel::where('id', '=', $detailId)->get();
        //$result = ServiceModel::where('id', '=', $deleteId)->update();
        // // dd($result);
        return $result;
        
    }

    public function updateServices(Request $req){

        $id   = $req->input('id');
        $name = $req->input('name');
        $des  = $req->input('des');
        $img  = $req->input('img');

        $result = ServiceModel::where('id', '=', $id)->update(
                                                        [   
                                                            'service_name' => $name,
                                                            'service_des'=>$des,
                                                            'service_img'=>$img     
                                                        ]
                                                    );
        // // dd($result);
        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
        
    }

    public function addServices(Request $req){

        $name = $req->input('name');
        $des  = $req->input('des');
        $img  = $req->input('img');

        $result = ServiceModel::insert(
                                        [   
                                            'service_name' => $name,
                                            'service_des'=>$des,
                                            'service_img'=>$img     
                                        ]
                                    );
        // // dd($result);
        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
        
    }

}
