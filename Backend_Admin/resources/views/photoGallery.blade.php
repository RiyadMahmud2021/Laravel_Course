@extends('layouts.app')
@section('title','Photo Gallery')

@section('content')

<div class="container-fluid m-0 text-center">
        <div class="row">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#PhotoModal" id="addNewPhotoBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
            </div>
        </div>

        <div class="row photoRow">
            <!-- <div class="col-md-3 p-1">
                <img class ="imgOnRow" src="http://127.0.0.1:4000/storage/d13MKH53dgORaj9J5wQXCiMDTksu7z1IXkV2iT8h.png">
            </div> -->
        </div>
        <button class="btn btn-sm btn-primary " id="LoadMoreBtn"> Load More </button>

</div>

    <!-- Modal -->
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div id="photo_form_id">
                         <input class="form-control" id="imgInput" type="file">
                         <img class="imgPreview mt-3" id="imgPreview" src="{{asset('images/default-image.png')}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button id="SavePhoto" type="button" class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

     <script type="text/javascript">

          $('#imgInput').change(function () {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (event) {
               var ImgSource = event.target.result;
               $('#imgPreview').attr('src',ImgSource);
               }
          })

        $('#SavePhoto').on('click',function () {
            $(this).html("<div class='spinner-border spinner-border-sm' role='status'></div>")
            
            var PhotoFile= $('#imgInput').prop('files')[0];
            var formData = new FormData();
            formData.append('photo',PhotoFile);

            
            axios.post("/photoUpload",formData)
          
            .then(function (response) {

                    $("#imgInput").val(''); // reset input file <input type = "file">
                    $("#imgPreview").attr('src','{{asset('images/default-image.png')}}'); // reset image preview <img >

                // alert(response.data); // debuging

                if(response.status==200 && response.data==1){
                    $('#PhotoModal').modal('hide');
                    $('#SavePhoto').html('Save');
                    toastr.success('Photo Uploaded');
                    LoadPhoto();
                }
                else{
                    $('#PhotoModal').modal('hide');
                    toastr.error('Photo Upload Failed');
                }
            })
            .catch(function (error) {
                $('#PhotoModal').modal('hide');
                toastr.error('Photo Upload Failed');
                $('#SavePhoto').html('Save');
            })
        })

        LoadPhoto();
        
        function LoadPhoto(){

            axios.get("/photos")
          
            .then(function (response) {
               // console.log(response.data);
               $('.photoRow').empty();
               $.each(response.data, function(i,item){
                   $("<div class='col-md-3 p-1'>").html(
                        "<img  class='imgOnRow' data-id="+ item['id'] +" src="+item['location'] +">" + 
                        "<button data-id="+ item['id'] +" data-photo="+ item['location'] +" class='btn deletePhoto btn-sm'> Delete</button>"
                   ).appendTo('.photoRow');
               })

               $('.deletePhoto').on('click',function (event) {
                    let id=$(this).data('id');
                    let photo=$(this).data('photo');
                    //alert(id);
                    photoDelete(photo,id);
                    event.preventDefault();
                })

           })
           .catch(function (error) {
            //    $('#PhotoModal').modal('hide');
            //    toastr.error('Photo Upload Failed');
            //    $('#SavePhoto').html('Save');
           })

        }
        
        $('#LoadMoreBtn').on('click',function () {
           let loadMoreBtn = $(this);
           let FirstImgID = $(this).closest('div').find('img').data('id');
           // alert(FirstImgID);
           LoadPhotoById(FirstImgID,loadMoreBtn);
        })

        imgID = 0;

        function LoadPhotoById(FirstImgID,loadMoreBtn){

            imgID = imgID + 8;
            var photoID = imgID + FirstImgID;
            url = "/photosById/"+ photoID; 
            // alert(url);
            // $('#LoadMoreBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") 
            loadMoreBtn.html("<div class='spinner-border spinner-border-sm' role='status'></div>")
            
            axios.get(url)
            .then(function (response) {
            // console.log(response.data);
            // $('#LoadMoreBtn').html("Load More");
                loadMoreBtn.html("Load More");
                $.each(response.data, function(i,item){ // We use "item" as "single column item" of a row
                    $("<div class='col-md-3 p-1'>").html(
                            "<img data-id="+ item['id'] +" class='imgOnRow' src="+item['location']+">" + 
                            "<button data-id="+ item['id'] +" data-photo="+ item['location'] +" class='btn deletePhoto btn-sm'> Delete</button>"
                    ).appendTo('.photoRow');
                })

                $('.deletePhoto').on('click',function (event) {
                    let id=$(this).data('id');
                    let photo=$(this).data('photo');
                    //alert(id);
                    photoDelete(photo,id);
                    event.preventDefault();
                })

            })
            .catch(function (error) {
            //    $('#PhotoModal').modal('hide');
            //    toastr.error('Photo Upload Failed');
            //    $('#SavePhoto').html('Save');
            })

        }

        function photoDelete(OldPhotoURL,id) {  
            let url="/photoDelete";
            let MyFormData = new FormData();

            MyFormData.append('OldPhotoURL',OldPhotoURL);
            MyFormData.append('id',id);

            axios.post(url,MyFormData)
            .then(function (response) {
                // alert(response.data);
                if(response.status == 200 && response.data == 1){
                    toastr.success('Photo Deleted');

                    // $('.photoRow').empty();
                    // LoadPhoto();
                    //Or
                    window.location.href="/photoGallery";
                }
                else{
                    toastr.error('Delete Failed and Try Again');
                }
            })
            .catch(function () {
                    toastr.error('Delete Failed and Try Again');
            })

        }

     </script>

@endsection