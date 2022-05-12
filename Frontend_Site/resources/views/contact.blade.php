@extends('layouts.app')

@section('title', 'Contact')

@section('content')

    <div class="container-fluid top-banner_parallax jumbotron mt-5 ">
        <div class="row d-flex justify-content-center pt-5">
            <div class="col-md-6  text-center pt-5 mt-5">
                <h1 class="page-top-title mt-3">- - যোগাযোগ করুন  - -</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7298.08571180952!2d90.41323182230722!3d23.852611900656736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c678e8d9d405%3A0xee33acb7a58fab49!2sAshkona%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1652364692004!5m2!1sen!2sbd" width="100%" height="370" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> আইনুসবাগ, আশকোনা, ঢাকা <i class="fas ml-2 fa-phone"></i>   ০১৭৫৫৯৩৫০৪৭  <i class="fas ml-2 fa-envelope"></i>   riyad.prof.bd@gmail.com </p>
                <h3 class="service-card-title">মেসেজ পাঠান </h3>
                <div id="course_form_id">
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
            </div>
                <button id="contactSendBtnId"  class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>
        </div>
    </div>

@endsection