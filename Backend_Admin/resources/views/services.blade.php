@extends('layouts.app')


@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <button id="addNewBtnId" class="btn my-3 btn-sm btn-danger"> Add New </button>
            <table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Image</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id = "service_table" > 
                
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="loaderDiv" class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-12 p-5 text-center ">
            <img class="animation_size mt-5" src="{{asset('images/loader.svg')}}">
        </div>
    </div>
</div>

<div id="wrongDiv" class="container  mt-5 d-none">
    <div class="row">
        <div class="col-md-12 mt-5 p-5 text-center ">
            <h2>Sorry, Something Went Wrong! See database connection (jq)</h2>  
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 id="serviceDeleteId" class="mt-4" hidden>   </h5>
        <!-- <h5 id="serviceDeleteId" class="mt-4 d-none">   </h5> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button data-id='' id="serviceDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body p-3 text-center">
            <h5 id="" class="mt-4">Edit Services</h5>
            <h5 id="serviceEditId" class="mt-4" hidden>   </h5>
            <div id="mainDivE" class="container mt-5 d-none">
                        <div class="form-group">
                            <input type="service_name" class="form-control" id="service_name" aria-describedby="emailHelp" placeholder="Service Name">                         
                        </div>
                        <div class="form-group">
                            <input type="service_des" class="form-control" id="service_des" placeholder="Service Description">                         
                        </div>
                        <div class="form-group">
                            <input type="" class="form-control" id="service_img" placeholder="Service Image Link">
                        </div>
            </div>
                <div id="loaderDivE" class="container">
                    <div class="row">
                        <div class="col-md-12 p-5 text-center ">
                            <img class="animation_size mt-5" src="{{asset('images/loader.svg')}}">
                        </div>
                    </div>
                </div>

                <div id="wrongDivE" class="container  mt-5 d-none">
                    <div class="row">
                        <div class="col-md-12 mt-5 p-5 text-center ">
                            <h2>Sorry, Something Went Wrong! See database connection (jq)</h2>  
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
            <button data-id='' id="serviceEditSaveBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div> 
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body p-3 text-center">
            <h5 id="" class="mt-4">Add New Services</h5>
            <h5 id="serviceEditId" class="mt-4" hidden>   </h5>
            <div id="mainDivE" class="container mt-3">
                <div id="service_form_id">
                        <div class="form-group">
                            <input type="service_name" class="form-control" id="add_service_name" aria-describedby="emailHelp" placeholder="Service Name">                         
                        </div>
                        <div class="form-group">
                            <input type="service_des" class="form-control" id="add_service_des" placeholder="Service Description">                         
                        </div>
                        <div class="form-group">
                            <input type="" class="form-control" id="add_service_img" placeholder="Service Image Link">
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
            <button data-id='' id="serviceAddSaveBtn" type="button" class="btn  btn-sm  btn-danger">Add</button>
        </div> 
    </div>
  </div>
</div>
<!-- Custom Required Message -->
<!-- 
<div class="toast btn-danger text-center" id="toast_message" role="dialog" style="position: absolute; top: 50px; right: 10px;">
    <div aria-live="polite" aria-atomic="true">        
        <h5 class="toast-body" id="textTaking"> </h5>
    </div>
</div> -->

@endsection

@section('script')

<script type="text/javascript">
getServicesD()


// ------------------------------------------------
// For Services Table
function getServicesD() {

    axios.get('/getServices')
        .then(function(response) {

            if (response.status == 200) {

                $('#loaderDiv').addClass('d-none');
                $('#mainDiv').removeClass('d-none');

                $('#serviceDataTable').DataTable().destroy(); // helps to refresh table
                $('#service_table').empty(); // helps to avoid cloning data at the time of deleting data

                var alldata = response.data;
                $.each(alldata, function(i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'><img class='table-img' src=" + alldata[i].service_img + "></td>" +
                        "<td class='th-sm'>" + alldata[i].service_name + "</td>" +
                        "<td class='th-sm'>" + alldata[i].service_des + "</td>" +
                        "<td class='th-sm'><a class='serviceEditBtn' data-id =" + alldata[i].id + "    ><i class='fas fa-edit'></i></a></td>" +
                        "<td class='th-sm'><a class='serviceDeleteBtn' data-id =" + alldata[i].id + "   ><i class='fas fa-trash-alt'></i></a></td>"
                        //  data-toggle='modal' data-target='#deleteModal' 
                    ).appendTo('#service_table');
                });

                // For Services Table Delete Icon Click
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');

                    $('#serviceDeleteId').html(id);
                    // $('#serviceDeleteConfirmBtn').attr('data-id', id);
                    $('#deleteModal').modal('show');

                })

                // For Services Table Edit Icon Click
                $('.serviceEditBtn').click(function() {
                    var id = $(this).data('id');

                    $('#serviceEditId').html(id);
                    servicesDetail(id);
                    // $('#serviceEditSaveBtn').attr('data-id', id);
                    $('#editModal').modal('show');

                })

                $('#serviceDataTable').DataTable({
                    "order": false
                }); // .DataTable()
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        });
}
// ------------------------------------------------ 

// ------------------------------------------------
// For Services Delete Modal Yes Button Click
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteId').html();
    //var id = $(this).data('id');
    servicesDelete(id);
})
// ------------------------------------------------


// For Service Delete Function
function servicesDelete(deleteID) {
    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
    axios.post('/deleteServices', {
            id: deleteID
        })
        .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("Yes");
            if (response.data == 1) {
                //alert('Success');
                $('#deleteModal').modal('hide');
                toastr.success('Successfully deleted');
                getServicesD();
            } else {
                //alert('Failed');
                $('#deleteModal').modal('hide');
                toastr.error('Failed !!! Something is wrong!!!');
                getServicesD();
            }
        })
        .catch(function(error) {
            // alert('Some is wrong!!!');
            toastr.error('Failed !!! Something is wrong!!!');
        })
}


// For Service Detail and Edit Function
function servicesDetail(detailID) {
    axios.post('/detailServices', {
            id: detailID,
        })
        .then(function(response) {
            if (response.status == 200) {

                $('#loaderDivE').addClass('d-none');
                $('#mainDivE').removeClass('d-none');

                var alldata = response.data;
                $('#service_name').val(alldata[0].service_name);
                $('#service_des').val(alldata[0].service_des);
                $('#service_img').val(alldata[0].service_img);

            } else {
                $('#loaderDivE').addClass('d-none');
                $('#wrongDivE').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivE').addClass('d-none');
            $('#wrongDivE').removeClass('d-none');
        })

}


// ------------------------------------------------
// For Services Edit Modal Save Button Click
$('#serviceEditSaveBtn').click(function() {
    var id = $('#serviceEditId').html();
    var name = $('#service_name').val();
    var des = $('#service_des').val();
    var img = $('#service_img').val();
    servicesUpdate(id, name, des, img);
})
// ------------------------------------------------

// ------------------------------------------------
// For Service Update Function
function servicesUpdate(editID, editName, editDes, editImg) {

    if (editName.length == 0) {
        // alert('Name Required');
        toastr.error('Name field is Required...');
        // $('#serviceEditSaveBtn').click(function() {
        //     $('#toast_message').toast('show');
        //     $('#textTaking').html("Name field is Required...");
        // })

    } else if (editDes.length == 0) {
        // alert('Descrption Required');
        toastr.error('Description field is Required...');
        // $('#serviceEditSaveBtn').click(function() {
        //     $('#toast_message').toast('show');
        //     $('#textTaking').html("Description field is Required...");
        // })
    } else if (editImg.length == 0) {
        // alert('Image Required');
        toastr.error('Image field is Required...');
        // $('#serviceEditSaveBtn').click(function() {
        //     $('#toast_message').toast('show');
        //     $('#textTaking').html("Image field is Required...");
        // })
    } else {
        $('#serviceEditSaveBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
        axios.post('/updateServices', {
                id: editID,
                name: editName,
                des: editDes,
                img: editImg
            })
            .then(function(response) {
                if (response.status == 200) {
                    $('#serviceEditSaveBtn').html("Save");

                    if (response.data == 1) {
                        $('#editModal').modal('hide');
                        //alert('Updated');
                        toastr.success('Updated');
                        // $('#serviceEditSaveBtn').click(function() {
                        //     $('#textTaking').html("Updated");
                        //     $('#toast_message').toast('show');
                        // })
                        getServicesD();
                    } else {
                        $('#editModal').modal('hide');
                        // alert('Not updated');
                        toastr.warning('No Update History');
                        // $('#serviceEditSaveBtn').click(function() {
                        //     $('#textTaking').html("Not updated");
                        //     $('#toast_message').toast('show');
                        // })
                        getServicesD();
                    }

                } else {
                    $('#editModal').modal('hide');
                    //alert('Some is wrong!!!');
                    toastr.error('Something is wrong!!!');
                }

            })
            .catch(function(error) {
                $('#editModal').modal('hide');
                //alert('Some is wrong!!!');
                toastr.error('Something is wrong!!!');
            })
    }
}
// ------------------------------------------------

// ------------------------------------------------
// For Add New Service Button click 
$('#addNewBtnId').click(function() {
    $('#addModal').modal('show');
})

// ------------------------------------------------
// For Services Add Modal Add Button Click
$('#serviceAddSaveBtn').click(function() {
    var name = $('#add_service_name').val();
    var des = $('#add_service_des').val();
    var img = $('#add_service_img').val();
    servicesAdd(name, des, img);
})
// ------------------------------------------------
// For Add New Service Function
function servicesAdd(sName, sDes, sImg) {

    if (sName.length == 0) {
        // alert('Name Required');
        toastr.error('Name field is Required...');
    } else if (sDes.length == 0) {
        // alert('Descrption Required');
        toastr.error('Description field is Required...');
    } else if (sImg.length == 0) {
        // alert('Image Required');
        toastr.error('Image field is Required...');
    } else {
        // form reset code start
        $(':input', '#service_form_id').not(':button, :submit, :reset, :hidden')
        .val('').prop('checked', false)
        .prop('selected', false);
        // form reset code end
        $('#serviceAddSaveBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
        axios.post('/addServices', {
                name: sName,
                des: sDes,
                img: sImg
            })
            .then(function(response) {
                if (response.status == 200) {
                    $('#serviceAddSaveBtn').html("Add");

                    if (response.data == 1) {
                        $('#addModal').modal('hide');
                        //alert('Updated');
                        toastr.success('Added');
                        getServicesD();
                    } else {
                        $('#addModal').modal('hide');
                        // alert('Not updated');
                        toastr.warning('No Added History');
                        getServicesD();
                    }

                } else {
                    $('#addModal').modal('hide');
                    //alert('Some is wrong!!!');
                    toastr.error('Something is wrong!!!');
                }

            })
            .catch(function(error) {
                $('#addModal').modal('hide');
                //alert('Some is wrong!!!');
                toastr.error('Something is wrong!!!');
            })
    }
}
</script>

@endsection 