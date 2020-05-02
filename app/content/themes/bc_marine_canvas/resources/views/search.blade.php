@extends('layouts.app')

@section('banner', App::background_image($search_banner))
@section('title', 'Search')

@section('content')
  <div class="container mt-4" role="document">
    @include('search.form')

    @if ($results)
      @include('search.result_meta')

      <div class="row">
        @foreach ($results as $post)
          <div class="col-12 py-3">
            @include('search.result')
          </div>
        @endforeach
      </div>
    @else
      @include('partials.empty_collection', ['collection_name' => 'results'])
    @endif

    @include('partials.pagination')
  </div>
@endsection
