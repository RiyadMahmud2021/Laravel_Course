<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModel;

class ReviewController extends Controller
{
    function reviewIndex(){
        return view('reviews');	
    }

    public function getReviewData(){

        $result = ReviewModel::orderBy('id','desc')->get();
        // dd($result);
        return $result;
        
    }

    function addReview(Request $req){
        $Review_name= $req->input('Review_name');
        $Review_desc= $req->input('Review_desc');
        $Review_img = $req->input('Review_img');
        $result= ReviewModel::insert([
                                    'name'=>$Review_name,
                                    'des'=>$Review_desc,
                                    'img'=>$Review_img,
                                ]);
   
        if($result==true){      
          return 1;
        }
        else{
         return 0;
        }
   }

    function deleteReview(Request $req){
        $id= $req->input('id');
        $result = ReviewModel::where('id','=',$id)->delete();

            if($result==true){      
            return 1;
            }
            else{
                return 0;
            }
    }

    
    function getReviewDetails(Request $req){
        $id= $req->input('id');
        $result=ReviewModel::where('id','=',$id)->get();
        return $result;
    }

    function reviewUpdate(Request $req){
        $id= $req->input('id');
        $Review_name= $req->input('Review_name');
        $Review_desc= $req->input('Review_desc');
        $Review_img = $req->input('Review_img');
   
        $result= ReviewModel::where('id','=',$id)->update([
                'name'=>$Review_name,
                'des'=>$Review_desc,
                'img'=>$Review_img,	
        ]);
   
        if($result==true){      
          return 1;
        }
        else{
         return 0;
        }
   }


}
