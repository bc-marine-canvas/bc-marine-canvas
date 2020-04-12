@php /* Template Name: Gallery */ @endphp

@extends('layouts.app')

@section('banner', App::background_image($gallery_page->banner()))
@section('title', $gallery_page->name())

@section('content')
  <div role="document">
    <div class="container mt-4">
      @include('gallery.intro')
      {{-- @include('gallery.filters') --}}
    </div>

    @if ($gallery)
      <div class="container-fluid">
        <div id="gallery" class="row">
          @foreach ($gallery as $image)
            @include('gallery.image')
          @endforeach
        </div>
      </div>
    @else
      <div class="container">
        @include('partials.empty_collection', ['collection_name' => 'images'])
      </div>
    @endif

    <div class="container mb-4">
      @include('partials.pagination')
    </div>
  </div>
@endsection
