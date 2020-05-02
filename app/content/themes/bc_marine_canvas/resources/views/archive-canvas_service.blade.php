@extends('layouts.app')

@section('banner', App::background_image($canvas_page->banner()))
@section('title', $canvas_page->name())

@section('content')
  <div role="document">
    @include('canvas.archive.intro', ['copy' => $canvas_page->intro_copy()])
    @include('canvas.archive.featured', [
      'copy' => $canvas_page->featured_copy(),
      'services' => $canvas_page->featured_services(),
    ])

    @if ($services)
      @include('canvas.archive.services')
    @else
      @include('partials.empty_collection', [
        'collection_name' => $canvas_page->name(),
      ])
    @endif
  </div>
@endsection
