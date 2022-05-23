<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;

class CourseController extends Controller
{
        public function courseIndex(){
    
            $courseData = CourseModel::orderBy('id','desc')->get();
    
            return view('courses', compact('courseData'));
        }
}
