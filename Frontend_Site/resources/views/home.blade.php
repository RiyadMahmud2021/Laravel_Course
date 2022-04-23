@section('title', 'Home')

@extends('layouts.app')

@section('content')
     @include('Components.homeBanner')
     @include('Components.homeService')
@endsection