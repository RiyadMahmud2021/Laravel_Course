@extends('layouts.app')

@section('title', 'Home')

@section('content')

     @include('Components.homeBanner')
     @include('Components.homeService')
     @include('Components.homeCourse')
     @include('Components.homeProject')
     @include('Components.homeContact')
     @include('Components.homeReview')
     
@endsection 