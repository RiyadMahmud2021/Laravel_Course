<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    public function homeIndex(){

        $userIp = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate = date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$userIp, 'visit_time'=>$timeDate]);
        
        // dd($userIp ); // Laravel dump & die
        // dd($timeDate );
        return view('home');
    }
}
