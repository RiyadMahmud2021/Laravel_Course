<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;

class CourseController extends Controller 
{
    public function coursesIndex(){

        return view('courses');
        
    }

    public function getCoursesData(){
        $result = CourseModel::orderBy('id','desc')->get();
        // dd($result);
        return $result;
    }

    public function addCourse(Request $req){

        $course_name = $req->input('course_name');
        $course_des = $req->input('course_des');
        $course_fee= $req->input('course_fee');     
        $course_totalenroll = $req->input('course_totalenroll'); 
        $course_totalclass= $req->input('course_totalclass'); 
        $course_link= $req->input('course_link'); 
        $course_img = $req->input('course_img'); 

        $result = CourseModel::insert(
                                        [   
                                            'course_name'=>$course_name,
                                            'course_des'=>$course_des,
                                            'course_fee'=>$course_fee,
                                            'course_totalenroll'=>$course_totalenroll,
                                            'course_totalclass'=>$course_totalclass,    	
                                            'course_link'=>$course_link,     
                                            'course_img'=>$course_img,  
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

    public function detailEachCourse(Request $req){

        $detailId = $req->input('id');

        $result = CourseModel::where('id', '=', $detailId)->get();
        //$result = ServiceModel::where('id', '=', $deleteId)->update();
        // // dd($result);
        return $result;
        
    }

    public function updateCourse(Request $req){

        $id= $req->input('id');
        $course_name= $req->input('course_name');
        $course_des = $req->input('course_des');
        $course_fee= $req->input('course_fee');     
        $course_totalenroll = $req->input('course_totalenroll'); 
        $course_totalclass= $req->input('course_totalclass'); 
        $course_link= $req->input('course_link'); 
        $course_img = $req->input('course_img');

        $result = CourseModel::where('id', '=', $id)->update(
                                                        [   
                                                            'course_name'=>$course_name,
                                                            'course_des'=>$course_des,
                                                            'course_fee'=>$course_fee,
                                                            'course_totalenroll'=>$course_totalenroll,
                                                             'course_totalclass'=>$course_totalclass,    	
                                                            'course_link'=>$course_link,     
                                                            'course_img'=>$course_img,  
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

    public function deleteCourse(Request $req){

        $deleteId = $req->input('id');
        $result = CourseModel::where('id', '=', $deleteId)->delete();
        // // dd($result);
        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
        
    }

    





}
