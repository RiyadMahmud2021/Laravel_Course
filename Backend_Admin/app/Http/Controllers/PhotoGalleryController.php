<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoModel;
use Illuminate\Support\Facades\Storage; // important 

class PhotoGalleryController extends Controller
{
    function photoIndex(){
        return view('photoGallery');
    }

    function photoUpload(Request $request){
        $photoPath = $request->file('photo')->store('public');
        // The explode() function breaks a string into an array. Note: The "separator" parameter cannot be an empty string. Note: This function is binary-safe. 
        
        $photoName = (explode('/',$photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location = "http://".$host."/storage/".$photoName;

        $result = PhotoModel::insert([
                                    'location'=>$location
                                ]);

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
        // return $result;

    }

    function photos(){
        return PhotoModel::take(8)->get();
    }

    function photosById(Request $request){
            $FirstID = $request->id;
            $LastID = $FirstID + 8;
        return PhotoModel::where('id','>=',$FirstID)->where('id','<',$LastID)->get();
    }

    function photoDelete(Request $request){
        $OldPhotoURL = $request->input('OldPhotoURL');
        $OldPhotoID = $request->input('id');

        $OldPhotoURLArray = explode("/", $OldPhotoURL);
        $OldPhotoName = end($OldPhotoURLArray); // end() method in php 
        $DeletePhotoFile= Storage::delete('public/'.$OldPhotoName);

        $DeleteRow= PhotoModel::where('id','=',$OldPhotoID)->delete();

        if($DeleteRow == true){
            return 1;
        }
        else{
            return 0;
        }
    }

}