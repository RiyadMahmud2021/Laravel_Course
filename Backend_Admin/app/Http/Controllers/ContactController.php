<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    function contactIndex(){

        return view('contacts');	

    }
    
    function getContactData(){

          $result = ContactModel::orderBy('id','desc')->get();
          return $result;

    }
    
    function deleteContact(Request $req){

         $id= $req->input('id');
         $result = ContactModel::where('id','=',$id)->delete();

         if($result==true){      
           return 1;
         }
         else{
             return 0;
         }

    }
}
