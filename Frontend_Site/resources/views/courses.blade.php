@extends('layouts.app')

@section('title', 'Courses')

@section('content')

     @include('Components.CoursePageTopBanner')
     @include('Components.AllCourses')

     
@endsection