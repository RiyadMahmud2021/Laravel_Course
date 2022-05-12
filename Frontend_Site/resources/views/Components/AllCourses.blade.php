<div class="container mt-5">
    <div class="row">


      @foreach($courseData as $key)
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img style="width: 200px; height: 200px;" class="w-100" src="{{$key->course_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$key->course_name}}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{$key->course_des}}</h6>
                    <h6 class="service-card-subTitle p-0 ">Fee: {{$key->course_fee}}/-</h6>
                    <h6 class="service-card-subTitle p-0 ">Total Classes: {{$key->course_totalclass}}</h6>
                    <a href="{{$key->course_link}}" target="_blank" class="normal-btn-outline mt-2 mb-4 btn">শুরু করুন </a>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>