@extends('layouts.app')

@section('banner', App::background_image($service->banner()))
@section('title', $service->name())

@section('content')
  @include('upholstery.single.intro', ['copy' => $service->intro_copy()])
  @include('upholstery.single.gallery', [
    'copy' => $service->gallery_copy(),
    'images' => $service->gallery(['limit' => 12]),
  ])
  {{-- @include('upholstery.single.related', [ --}}
  {{--   'copy' => $service->upholstery_copy(), --}}
  {{--   'related_services' => $service->upholstery_services(), --}}
  {{-- ]) --}}
  {{-- @include('upholstery.single.cta', ['form' => $service->cta()]) --}}
@endsection
