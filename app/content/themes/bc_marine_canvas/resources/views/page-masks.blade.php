@php /* Template Name: Masks */ @endphp

@extends('layouts.app')

@section('banner', App::background_image($masks_page->banner()))
@section('title', $masks_page->name())

@section('content')
  <div role="document">
    @include('masks.intro')
    @include('masks.checklist')
    @include('masks.tabs')
    @include('masks.cta')
  </div>
@endsection
