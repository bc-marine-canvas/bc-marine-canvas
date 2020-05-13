@extends('layouts.app')

@section('content')
  <div class="container flex-grow-1 my-4" role="document">
    <div class="row">
      <div class="col">
        @while(have_posts()) @php the_post() @endphp
          @php the_content() @endphp
        @endwhile
      </div>
    </div>
  </div>
@endsection
