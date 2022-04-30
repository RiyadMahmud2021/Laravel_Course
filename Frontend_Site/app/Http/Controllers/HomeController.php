<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServiceModel;
use App\Models\CourseModel;
use App\Models\ProjectModel;

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

        // dd($userIp ); // Laravel dump & die
        // dd($timeDate );
        return view('home', compact('serviceData','courseData','projectData'));
    }
}