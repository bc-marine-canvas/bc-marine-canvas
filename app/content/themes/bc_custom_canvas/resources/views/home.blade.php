@extends('layouts.with_sidebar')

@section('banner', App::background_image($posts_page->banner()))
@section('title', 'Blog')

@section('content')
  <div class="container mt-3">
    @if ($posts)
      @include('content', ['posts' => $posts])
    @else
      @include('partials.empty_collection', ['collection_name' => 'posts'])
    @endif

    @include('partials.pagination')
  </div>
@endsection
