@extends('layouts.app')
@section('title','Projects')

@section('content')

<div id="mainDivProject"  class="container  d-none">
     <div class="row">
          <div class="col-md-12 p-3">
          <button id="addNewProjectBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
               <table id="ProjectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                    <tr>
                         <th class="th-sm">Name</th>
                         <th class="th-sm">Description</th>
                         <th class="th-sm">Edit</th>
                         <th class="th-sm">Delete</th>
                    </tr>
               </thead>
                    <tbody id="Project_table">

                    </tbody>
               </table>
          </div>
     </div>
</div>

<div id="loaderDivProject" class="container mt-5 pt-5">
     <div class="row">
          <div class="col-md-12 text-center p-5">
               <img class="animation_size m-5" src="{{asset('images/loader.svg')}}">
          </div>
     </div>
</div>


<div id="WrongDivProject" class="container d-none">
     <div class="row">
          <div class="col-md-12 text-center p-5">
               <h3>Something Went Wrong !</h3>
          </div>
     </div>
</div>

<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add New Project</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body  text-center">
            <div class="container">
               <div class="row">
                  <div id="project_form_id" class="col-md-12">
                     <input id="ProjectNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
                     <input id="ProjectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
                     <input id="ProjectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                     <input id="ProjectImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
               <button  id="ProjectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  text-center">

                <h5 id="ProjectEditId" class="mt-4 d-none"> </h5>

                <div id="ProjectEditForm" class="container d-none">

                    <div class="row">
                        <div class="col-md-12">
                            <input id="ProjectNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
                            <input id="ProjectDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
                            <input id="ProjectLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                            <input id="ProjectImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
                        </div>
                    </div>

               </div>

               <div id="ProjectEditLoader" class="container">
                    <div class="row">
                         <div class="col-md-12 p-5 text-center ">
                              <img class="animation_size mt-5" src="{{asset('images/loader.svg')}}">
                         </div>
                    </div>
               </div>

               <div id="ProjectEditWrong" class="container  mt-5 d-none">
                    <div class="row">
                        <div class="col-md-12 mt-5 p-5 text-center ">
                            <h2>Sorry, Something Went Wrong! See database connection (jq)</h2>  
                        </div>
                    </div>
               </div> 

                
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="ProjectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body p-3 text-center">
            <h5 class="mt-4">Do You Want To Delete?</h5>
            <h5 id="ProjectDeleteId" class="mt-4 d-none">   </h5>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
            <button  id="ProjectDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
         </div>
      </div>
   </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
getProjectData();

// For Project Table
function getProjectData() {
     axios.get('/getProjects')
 
         .then(function(response) {
 
             $('#mainDivProject').removeClass('d-none');
             $('#loaderDivProject').addClass('d-none');
 
             $('#ProjectDataTable').DataTable().destroy();
             $('#Project_table').empty();
 
             if (response.status == 200) {
                 var dataz = response.data;
                 $.each(dataz, function(i, item) {
                     $('<tr>').html(
                         "<td>" + dataz[i].project_name + "</td>" +
                         "<td>" + dataz[i].project_desc + "</td>" +
                         "<td><a class='ProjectEditBtn' data-id=" + dataz[i].id + "><i class='fas fa-edit'></i></a></td>" +
                         "<td><a class='ProjectDeleteBtn' data-id=" + dataz[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                     ).appendTo('#Project_table');
                 });
 
                 $('.ProjectDeleteBtn').click(function() {
 
                     var id = $(this).data('id');
                     $('#ProjectDeleteId').html(id);
                     $('#deleteProjectModal').modal('show');
                 })
 
                 $('.ProjectEditBtn').click(function() {
                     var id = $(this).data('id');
                     ProjectUpdateDetail(id);
                     $('#ProjectEditId').html(id);
                     $('#updateProjectModal').modal('show');
                 })
                  $('#ProjectDataTable').DataTable({"order":false});
                  $('.dataTables_length').addClass('bs-select');
 
             } else {
                 $('#loaderDivProject').addClass('d-none');
                 $('#WrongDivProject').removeClass('d-none');
             }
         })
         .catch(function(error) {
             $('#loaderDivProject').addClass('d-none');
             $('#WrongDivProject').removeClass('d-none');
         });
 
 }
 
 // For Project Add 
 
 $('#addNewProjectBtnId').click(function() {
     $('#addProjectModal').modal('show');
 });
 
 $('#ProjectAddConfirmBtn').click(function() {
     var ProjectName = $('#ProjectNameId').val();
     var ProjectDes = $('#ProjectDesId').val();
     var ProjectLink = $('#ProjectLinkId').val();
     var ProjectImg = $('#ProjectImgId').val();
     addProject(ProjectName, ProjectDes, ProjectLink, ProjectImg);
 })
 
 
 function addProject(ProjectName, ProjectDes, ProjectLink, ProjectImg) {
 
     if (ProjectName.length == 0) {
         toastr.error('Project Name is Empty !');
     } else if (ProjectDes.length == 0) {
         toastr.error('Project Description is Empty !');
     } else if (ProjectLink.length == 0) {
         toastr.error('Project Link is Empty !');
     } else if (ProjectImg.length == 0) {
         toastr.error('Project Image is Empty !');
     } else {
         $('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
         axios.post('/addProject', {
                 project_name: ProjectName,
                 project_desc: ProjectDes,
                 project_link: ProjectLink,
                 project_img: ProjectImg,
             })
             .then(function(response) {
                    // form reset code start
                    $(':input', '#project_form_id').not(':button, :submit, :reset, :hidden')
                    .val('').prop('checked', false)
                    .prop('selected', false);
                    // form reset code end
                 $('#ProjectAddConfirmBtn').html("Save");
                 if (response.status == 200) {
                     if (response.data == 1) {
                         $('#addProjectModal').modal('hide');
                         toastr.success('Added');
                         getProjectData();
                     } else {
                         $('#addProjectModal').modal('hide');
                         toastr.error('Add Failed');
                         getProjectData();
                     }
                 } else {
                     $('#addProjectModal').modal('hide');
                     toastr.error('Something Went Wrong !');
                 }
             })
             .catch(function(error) {
                 $('#addProjectModal').modal('hide');
                 toastr.error('Something Went Wrong !');
             });
     }
 
 }
 
 // Project Update
 function ProjectUpdateDetail(detailID) {
     axios.post('/detailProject', {
             id: detailID
         })
         .then(function(response) {
             if (response.status == 200) {
                 $('#ProjectEditForm').removeClass('d-none');
                 $('#ProjectEditLoader').addClass('d-none');
                 var dataz = response.data;
                 $('#ProjectNameUpdateId').val(dataz[0].project_name);
                 $('#ProjectDesUpdateId').val(dataz[0].project_desc);
                 $('#ProjectLinkUpdateId').val(dataz[0].project_link);
                 $('#ProjectImgUpdateId').val(dataz[0].project_img);
             } else {
                 $('#ProjectEditLoader').addClass('d-none');
                 $('#ProjectEditWrong').removeClass('d-none');
             }
         })
         .catch(function(error) {
             $('#ProjectEditLoader').addClass('d-none');
             $('#ProjectEditWrong').removeClass('d-none');
         });
 }
 
 $('#ProjectUpdateConfirmBtn').click(function() {
     var ProjectID = $('#ProjectEditId').html();
     var ProjectName = $('#ProjectNameUpdateId').val();
     var ProjectDes = $('#ProjectDesUpdateId').val();
     var ProjectLink = $('#ProjectLinkUpdateId').val();
     var ProjectImg = $('#ProjectImgUpdateId').val();
     updateProject(ProjectID, ProjectName, ProjectDes, ProjectLink, ProjectImg);
 })
 
 function updateProject(ProjectID, ProjectName, ProjectDes, ProjectLink, ProjectImg) {
 
     if (ProjectName.length == 0) {
         toastr.error('Project Name is Empty !');
     } else if (ProjectDes.length == 0) {
         toastr.error('Project Description is Empty !');
     } else if (ProjectLink.length == 0) {
         toastr.error('Project Link is Empty !');
     } else if (ProjectImg.length == 0) {
         toastr.error('Project Image is Empty !');
     } else {
         $('#ProjectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
         axios.post('/updateProject', {
                 id: ProjectID,
                 project_name: ProjectName,
                 project_desc: ProjectDes,
                 project_link: ProjectLink,
                 project_img: ProjectImg,
             })
             .then(function(response) {
                 $('#ProjectUpdateConfirmBtn').html("Save");
                 if (response.status == 200) {
                     if (response.data == 1) {
                         $('#updateProjectModal').modal('hide');
                         toastr.success('Updated');
                         getProjectData();
                     } else {
                         $('#updateProjectModal').modal('hide');
                         toastr.error('Update Fail');
                         getProjectData();
                     }
                 } else {
                     $('#updateProjectModal').modal('hide');
                     toastr.error('Something Went Wrong !');
                 }
             })
             .catch(function(error) {
                 $('#updateProjectModal').modal('hide');
                 toastr.error('Something Went Wrong !');
             });
     }
 }
 
 // Project Delete
 $('#ProjectDeleteConfirmBtn').click(function() {
     var id = $('#ProjectDeleteId').html();
     deleteProject(id);
 })
 
 function deleteProject(deleteID) {
     $('#ProjectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
     axios.post('/deleteProject', {
             id: deleteID
         })
         .then(function(response) {
             $('#ProjectDeleteConfirmBtn').html("Save");
             if (response.status == 200) {
                 if (response.data == 1) {
                     $('#deleteProjectModal').modal('hide');
                     toastr.success('Deleted');
                     getProjectData();
                 } else {
                     $('#deleteProjectModal').modal('hide');
                     toastr.error('Delete Failed');
                     getProjectData();
                 }
             } else {
                 //   $('#ProjectDeleteConfirmBtn').html("Save");
                 $('#deleteProjectModal').modal('hide');
                 toastr.error('Something Went Wrong !');
             }
         })
         .catch(function(error) {
             // $('#ProjectDeleteConfirmBtn').html("Yes");
             $('#deleteProjectModal').modal('hide');
             toastr.error('Something Went Wrong !');
         });
 }
</script>

@endsection 