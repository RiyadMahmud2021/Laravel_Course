<div class="container section-marginTop text-center">
<h1 class="section-title text-center">মন্তব্য</h1>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 text-center pt-5">
            <div id="two" class="owl-carousel mb-4 owl-theme">
                @foreach($reviewData as $key)
                <div class="item m-1 text-center ">
                    <img class="review-img text-center" src="{{$key->img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-3">{{$key->name}}</h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{$key->des}}</h6>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>