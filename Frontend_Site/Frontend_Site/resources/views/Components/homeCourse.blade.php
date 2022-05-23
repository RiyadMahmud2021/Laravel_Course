<div class="container section-marginTop text-center">
    <h1 class="section-title">কোর্স সমূহ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">
         @foreach($courseData as $key)
          <div class="col-md-4 thumbnail-container">
                    <img style="width: 200px; height: 200px;" src="{{ $key->course_img }}" alt="Avatar" class="thumbnail-image ">
                    <div class="thumbnail-middle">
                         <h1 class="thumbnail-title"> {{ $key->course_name }} </h1>
                         <h1 class="thumbnail-subtitle"> {{ $key->course_des }} </h1>
                         <button target="_blank" href="{{$key->course_link}}" class="normal-btn btn">শুরু করুন</button>
                         <!-- target="_blank" : Opens the linked document in a new window or tab. _self. Opens the linked document in the same frame as it was clicked (this is default) -->
                    </div>
          </div>
          @endforeach
    </div>
</div>