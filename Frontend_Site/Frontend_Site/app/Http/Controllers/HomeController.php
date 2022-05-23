<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServiceModel;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\ContactModel;
use App\Models\ReviewModel;

class HomeController extends Controller
{
    public function homeIndex(){

        $userIp = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate = date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$userIp, 'visit_time'=>$timeDate]);
        $serviceData = ServiceModel::get();
        $courseData = CourseModel::orderBy('id','desc')->limit(6)->get();
        $projectData = ProjectModel::orderBy('id','desc')->limit(10)->get();
        $reviewData = ReviewModel::orderBy('id','desc')->get();

        // dd($userIp ); // Laravel dump & die
        // dd($timeDate );
        return view('home', compact('serviceData','courseData','projectData','reviewData'));
    }

    public function sendContact(Request $request){

        $contact_name = $request->input('contact_name');
        $contact_email = $request->input('contact_email');
        $contact_mobile = $request->input('contact_mobile');
        $contact_msg = $request->input('contact_msg');

        $result = ContactModel::insert(
            [   
                'contact_name'=>$contact_name,
                'contact_email'=>$contact_email,
                'contact_mobile'=>$contact_mobile,
                'contact_msg'=>$contact_msg,
  	
            ]
        );

        // dd($result);
        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }
}