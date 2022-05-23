<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;

class ProjectController extends Controller
{
    public function projectIndex(){

        $projectData = ProjectModel::orderBy('id','desc')->get();

        return view('projects', compact('projectData'));
    }
}
