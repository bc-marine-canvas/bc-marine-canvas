@php /* Template Name: Custom Template */ @endphp

@extends('layouts.app')

@section('banner', App::background_image($custom_page->banner()))
@section('title', $custom_page->name())

@section('content')
  <div class="mb-5" role="document">
    @foreach ($custom_page->content() as $content)
      @include("page.{$content['type']}", ['content' => $content['content']])
    @endforeach
  </div>
@endsection
