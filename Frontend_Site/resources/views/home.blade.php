@section('title', 'Home')

@extends('layouts.app')

@section('content')

     @include('Components.homeBanner')
     @include('Components.homeService')
     @include('Components.homeCourse')
     @include('Components.homeProject')
     @include('Components.homeContact')
     
@endsection