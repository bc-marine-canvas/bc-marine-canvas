@if (!App\display_map_banner())
  @include('partials.image_banner')
@else
  @include('partials.map_banner')
@endif
