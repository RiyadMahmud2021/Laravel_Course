<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\ReviewModel;
use App\Models\ServiceModel;  
use App\Models\VisitorModel;

class DashboardController extends Controller
{
    public function dashboardIndex(){

        $TotalContact= ContactModel::count();
        $TotalCourse=CourseModel::count();
        $TotalProject=ProjectModel::count();
        $TotalReview=ReviewModel::count();
        $TotalService=ServiceModel::count();
        $TotalVisitor=VisitorModel::count();

        return view('dashboard',compact(
                                        'TotalContact',
                                        'TotalCourse',
                                        'TotalProject',
                                        'TotalReview',
                                        'TotalService',
                                        'TotalVisitor'
                                    ));
    }
}
