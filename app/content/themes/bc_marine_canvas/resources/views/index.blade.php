@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @if (have_posts())
        @while (have_posts()) @php the_post() @endphp
          @include('content-' . get_post_type())
        @endwhile
      @else
        <div class="col py-3">
          <div class="alert alert-info">Sorry, no posts found.</div>
        </div>
      @endif
    </div>
    <div class="row">
      <div class="col">
        {!! get_the_posts_navigation() !!}
      </div>
    </div>
 </div>
@endsection
