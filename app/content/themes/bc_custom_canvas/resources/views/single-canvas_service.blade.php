@extends('layouts.app')

@section('banner', App::background_image($service->banner()))
@section('title', $service->name())

@section('content')
  @include('canvas.single.intro', ['copy' => $service->intro_copy()])
  @include('canvas.single.gallery', [
    'copy' => $service->gallery_copy(),
    'images' => $service->gallery(['limit' => 12]),
  ])

  {{-- @include('canvas.single.related', [ --}}
  {{--   'copy' => $service->upholstery_copy(), --}}
  {{--   'related_services' => $service->upholstery_services(), --}}
  {{-- ]) --}}
  {{-- @include('canvas.single.cta', ['form' => $service->cta()]) --}}
@endsection
