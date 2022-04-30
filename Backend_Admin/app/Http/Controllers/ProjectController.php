<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;

class ProjectController extends Controller
{
    function projectIndex(){
        return view('project');	
    }

    function getProjectData(){
        $result = ProjectModel::orderBy('id','desc')->get();
        // dd($result);
        return $result;
    }

    public function addProject(Request $req){

        $project_name= $req->input('project_name');
        $project_desc= $req->input('project_desc');
        $project_link= $req->input('project_link');
        $project_img = $req->input('project_img');

        $result= ProjectModel::insert([
            'project_name'=>$project_name,
            'project_desc'=>$project_desc,
            'project_link'=>$project_link,
           'project_img'=>$project_img,
        ]);
   
        if($result==true){      
          return 1;
        }
        else{
          return 0;
        }
   }
   
   public function detailEachProject(Request $req){

        $detailId = $req->input('id');

        $result = ProjectModel::where('id', '=', $detailId)->get();
        //$result = ServiceModel::where('id', '=', $deleteId)->update();
        // // dd($result);
        return $result;
    
    }

    public function updateProject(Request $req){

        $id= $req->input('id');
        $project_name= $req->input('project_name');
        $project_desc= $req->input('project_desc');
        $project_link= $req->input('project_link');
        $project_img = $req->input('project_img');

        $result = ProjectModel::where('id', '=', $id)->update(
                                                        [   
                                                            'project_name'=>$project_name,
                                                            'project_desc'=>$project_desc,
                                                            'project_link'=>$project_link,
                                                            'project_img'=>$project_img,    
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

    function deleteProject(Request $req){
        $id= $req->input('id');
        $result= ProjectModel::where('id','=',$id)->delete();
   
        if($result==true){      
          return 1;
        }
        else{
            return 0;
        }
   }

}
