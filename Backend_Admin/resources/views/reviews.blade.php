@extends('layouts.app')
@section('title','Reviews')

@section('content')

<div id="mainDivReview"  class="container  d-none">
     <div class="row">
          <div class="col-md-12 p-3">
               <button id="addNewReviewBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
               <table id="ReviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                         <tr>
                              <th class="th-sm">Name</th>
                              <th class="th-sm">Description</th>
                              <th class="th-sm">Edit</th>
                              <th class="th-sm">Delete</th>
                         </tr>
                    </thead>
                    <tbody id="Review_table">

                    </tbody>
               </table>
          </div>
     </div>
</div>

<div id="loaderDivReview" class="container">
     <div class="row">
          <div class="col-md-12 text-center p-5">
          <img class="loading-icon animation_size m-5" src="{{asset('images/loader.svg')}}">
          </div>
     </div>
</div>

<div id="WrongDivReview" class="container d-none">
     <div class="row">
          <div class="col-md-12 text-center p-5">
          <h3>Something Went Wrong !</h3>
          </div>
     </div>
</div>

<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Add New Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body  text-center">
                    <div class="container">
                         <div class="row">
                              <div id="review_add_form_id" class="col-md-12">
                                   <input id="ReviewNameId" type="text" id="" class="form-control mb-3" placeholder="Review Name">
                                   <input id="ReviewDesId" type="text" id="" class="form-control mb-3" placeholder="Review Description">
                                   <input id="ReviewImgId" type="text" id="" class="form-control mb-3" placeholder="Review Image">
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                         <button  id="ReviewAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="modal fade" id="updateReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header">
        <h5 class="modal-title">Update Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     </div>
      <div class="modal-body  text-center">
          <h5 id="ReviewEditId" class="mt-4 d-none">  </h5>
          
          <div id="ReviewEditForm" class="container d-none">
               <div class="row">
                    <div id="review_update_form_id" class="col-md-12">
                         <input id="ReviewNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Name">
                         <input id="ReviewDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Description">  
                         <input id="ReviewImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Image">
                    </div>
               </div>
          </div>
               <img id="ReviewEditLoader" class="loading-icon animation_size m-5" src="{{asset('images/loader.svg')}}">
               <h5 id="ReviewEditWrong" class="d-none">Something Went Wrong !</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="ReviewUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 id="ReviewDeleteId" class="mt-4 d-none">   </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="ReviewDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script type="text/javascript">

getReviewData();
//For Review Table 
function getReviewData() {
    axios.get('/getReviews')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivReview').removeClass('d-none');
                $('#loaderDivReview').addClass('d-none');
                
                $('#ReviewDataTable').DataTable().destroy();
                $('#Review_table').empty();

                var dataz = response.data;
                $.each(dataz, function(i, item) {
                    $('<tr>').html(
                        "<td>"+dataz[i].name+"</td>" +
                        "<td>"+dataz[i].des+"</td>" +  
                        "<td><a class='ReviewEditBtn' data-id="+dataz[i].id+"><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='ReviewDeleteBtn' data-id="+dataz[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#Review_table');
                });
                     $('.ReviewDeleteBtn').click(function(){                      
                         var id= $(this).data('id');
                         $('#ReviewDeleteId').html(id);
                         $('#deleteReviewModal').modal('show');
                     })
                     $('.ReviewEditBtn').click(function(){
                        var id= $(this).data('id');
                        reviewUpdateDetails(id);
                        $('#ReviewEditId').html(id);
                        $('#updateReviewModal').modal('show');
                     })
                  $('#ReviewDataTable').DataTable({"order":false});
                  $('.dataTables_length').addClass('bs-select');
            } else {
                $('#loaderDivReview').addClass('d-none');
                $('#WrongDivReview').removeClass('d-none');
            }
        })
        .catch(function(error) {
                $('#loaderDivReview').addClass('d-none');
                $('#WrongDivReview').removeClass('d-none');
        });
}

$('#addNewReviewBtnId').click(function(){
  $('#addReviewModal').modal('show');
});

$('#ReviewAddConfirmBtn').click(function(){
  var ReviewName=$('#ReviewNameId').val();
  var ReviewDes=$('#ReviewDesId').val();
  var ReviewImg=$('#ReviewImgId').val();
  addReview(ReviewName,ReviewDes,ReviewImg);
})

function addReview(ReviewName,ReviewDes,ReviewImg) {
  
    if(ReviewName.length==0){
     toastr.error('Review Name is Empty !');
    }
    else if(ReviewDes.length==0){
     toastr.error('Review Description is Empty !');
    }
    else if(ReviewImg.length==0){
      toastr.error('Review Image is Empty !');
    }
    else{
    $('#ReviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
    axios.post('/addReview', {
            Review_name: ReviewName,
            Review_desc: ReviewDes,
            Review_img: ReviewImg,                                    
        })
        .then(function(response) {
               // form reset code start
               $(':input', '#review_add_form_id').not(':button, :submit, :reset, :hidden')
               .val('').prop('checked', false)
               .prop('selected', false);
               // form reset code end
            $('#ReviewAddConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#addReviewModal').modal('hide');
                toastr.success('Added');
                getReviewData();
            } else {
                $('#addReviewModal').modal('hide');
                toastr.error('Add Failed');
                getReviewData();
            }  
         } 
         else{
             $('#addReviewModal').modal('hide');
             toastr.error('Something Went Wrong !');
         }   
    })
    .catch(function(error) {
             $('#addReviewModal').modal('hide');
             toastr.error('Something Went Wrong !');
   });
}
}
 // Review Delete Confirm 
$('#ReviewDeleteConfirmBtn').click(function(){
   var id= $('#ReviewDeleteId').html();
   deleteReview(id);
})
 // Review Delete
function deleteReview(deleteID) {
  $('#ReviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
    axios.post('/deleteReview', {
            id: deleteID
        })
        .then(function(response) {
            $('#ReviewDeleteConfirmBtn').html("Yes");
            if(response.status==200){
               if (response.data == 1) {
                    $('#deleteReviewModal').modal('hide');
                    toastr.success('Deleted');
               getReviewData();
            } else {
                $('#deleteReviewModal').modal('hide');
                toastr.error('Delete Failed');
               getReviewData();
            }
            }
            else{
              $('#ReviewDeleteConfirmBtn').html("Yes");
             $('#deleteReviewModal').modal('hide');
             toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
             $('#ReviewDeleteConfirmBtn').html("Yes");
             $('#deleteReviewModal').modal('hide');
             toastr.error('Something Went Wrong !');
        });
}
        
        // Review Update
        function reviewUpdateDetails(detailsID){
                  axios.post('/reviewDetails', {
                    id: detailsID
                  })
                 .then(function(response) {
                   if(response.status==200){
                        $('#ReviewEditForm').removeClass('d-none');
                        $('#ReviewEditLoader').addClass('d-none');    
                        var dataz = response.data;
                        $('#ReviewNameUpdateId').val(dataz[0].name);
                        $('#ReviewDesUpdateId').val(dataz[0].des);
                        $('#ReviewImgUpdateId').val(dataz[0].img);
                    }
                  
                  else{
                      $('#ReviewEditLoader').addClass('d-none');
                      $('#ReviewEditWrong').removeClass('d-none');
                    }
                  })
                  .catch(function(error) {
                      $('#ReviewEditLoader').addClass('d-none');
                      $('#ReviewEditWrong').removeClass('d-none');
                });
        }
$('#ReviewUpdateConfirmBtn').click(function(){
     var ReviewID=$('#ReviewEditId').html();
     var  ReviewName=$('#ReviewNameUpdateId').val();
     var  ReviewDes=$('#ReviewDesUpdateId').val();
     var  ReviewImg=$('#ReviewImgUpdateId').val();
     reviewUpdate(ReviewID,ReviewName,ReviewDes,ReviewImg);
})
function reviewUpdate(ReviewID,ReviewName,ReviewDes,ReviewImg) {
  
    if(ReviewName.length==0){
     toastr.error('Review Name is Empty !');
    }
    else if(ReviewDes.length==0){
     toastr.error('Review Description is Empty !');
    }
    else if(ReviewImg.length==0){
      toastr.error('Review Image is Empty !');
    }
    else{
    $('#ReviewUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
    axios.post('/reviewUpdate', {
            id: ReviewID,
            Review_name:ReviewName,
            Review_desc:ReviewDes,           
            Review_img:ReviewImg,   
        })
        .then(function(response) {
            $('#ReviewUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#updateReviewModal').modal('hide');
                toastr.success('Updated');
                getReviewData();
            } else {
                $('#updateReviewModal').modal('hide');
                toastr.error('Update Failed');
                getReviewData();
            }  
         } 
         else{
            $('#updateReviewModal').modal('hide');
             toastr.error('Something Went Wrong !');
         }   
    })
    .catch(function(error) {
        $('#updateReviewModal').modal('hide');
        toastr.error('Something Went Wrong !');
   });
}
}

</script>

@endsection 