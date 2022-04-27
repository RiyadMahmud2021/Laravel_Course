@extends('layouts.app')


@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
            <img class="animation_size mt-5" src="{{asset('images/loading-io.svg')}}">
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
                            <img class="animation_size mt-5" src="{{asset('images/loading-io.svg')}}">
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
</script>

@endsection 