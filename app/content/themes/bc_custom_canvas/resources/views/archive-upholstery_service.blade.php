@extends('layouts.app')

@section('banner', App::background_image($upholstery_page->banner()))
@section('title', $upholstery_page->name())

@section('content')
  <div role="document">
    @include('upholstery.archive.intro', [
      'copy' => $upholstery_page->intro_copy(),
    ])
    @include('upholstery.archive.featured', [
      'copy' => $upholstery_page->featured_copy(),
      'services' => $upholstery_page->featured_services(),
    ])

    @if ($services)
      @include('upholstery.archive.services')
    @else
      @include('partials.empty_collection', [
        'collection_name' => $upholstery_page->name(),
      ])
    @endif
  </div>
@endsection
