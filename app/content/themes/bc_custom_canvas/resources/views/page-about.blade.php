@php /* Template Name: About */ @endphp

@extends('layouts.app')

@section('banner', App::background_image($about_page->banner()))
@section('title', $about_page->name())

@section('content')
  <div role="document">
    @include('about.main_copy')
  </div>
@endsection
