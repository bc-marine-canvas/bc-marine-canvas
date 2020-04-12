<div class="container mt-5">
  <div class="row">
    <div class="col d-flex align-items-center justify-content-center">
      <h2>{{ $home_page->gallery_copy()['heading'] }}</h2>
    </div>
  </div>
</div>
<div id="gallery" class="row no-gutters my-3 d-flex align-items-center justify-content-center">
  @foreach ($home_page->gallery() as $image)
    <div class="h-100 col-md-6 col-xl-3 d-flex align-items-center justify-content-center gallery-item" data-src="{!! $image['full'] !!}">
      <img class="mw-100 m-3" src="{!! $image['thumbnail'] !!}">
    </div>
  @endforeach
</div>
<div class="container pb-5">
  <div class="row">
    <div class="my-4 col d-flex justify-content-center align-items-center">
      <a class="btn btn-secondary" href="{!! $home_page->gallery_copy()['link'] !!}">{{ $home_page->gallery_copy()['button_text'] }}</a>
    </div>
  </div>
</div>
