@extends('layouts.app1')
@section('title','Admin Login')

@section('content')
<div class="container justify-content-center ">
     <div class="row d-flex mt-5 mb-5">
          <div class="col-md-10 card bg-light">
               <div class="row mt-5 justify-content-center">
                    <div style="height: 450px" class="col-md-6 p-3">
                         <form  action=" "  class="m-5 loginForm"> 
                              <!-- must form tag for using serialize array -->
                              <div class="form-group">
                                   <label for="exampleInputEmail1">User Name</label>
                                   <input required="" name="userName" value="" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter User Name">
                              </div>
                              <div class="form-group">
                                   <label for="exampleInputPassword1">Password</label>
                                   <input  required="" name="userPassword"  value="" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                              <!-- required=""  for html form validation-->
                              </div>
                              <div class="form-group"> 
                                   <button name="submit" type="submit" class="btn btn-block btn-danger">Login</button>
                              </div>
                         </form>
                    </div>

                    <div style="height: 450px" class="col-md-6">
                         <img class="w-75" src="images/loginAnimation.gif">
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection

@section('script')

<script type="text/javascript">

$('.loginForm').on('submit',function (event) {
        event.preventDefault();
        let formData=$(this).serializeArray();
        let userName=formData[0]['value'];
        let password=formData[1]['value'];

        axios.post('/onLogin',{
            user : userName,
            pass : password
        })
        .then(function (response) {
           if(response.status == 200 && response.data == 1){
                window.location.href='/dashboard';
           }
           else{
               toastr.error('Login Failed ! Try Again');
           }
        })
        .catch(function (error) {
          // toastr.error('Login Failed ! Try Again');
        })
    })

</script>

@endsection 