<div class="bg-gray">
  <div class="container py-4">
    <div class="row">
      <div class="col text-center">
        <h2 class="brands-gallery">{{ $copy['heading'] }}</h2>
      </div>
    </div>
  </div>
</div>
<div id="gallery" class="row no-gutters d-flex align-items-center justify-content-center my-4">
  @foreach ($images as $image)
    <div class="h-100 col-md-6 col-xl-3 d-flex align-items-center justify-content-center gallery-item" data-src="{!! $image['full'] !!}">
      <img class="mw-100 px-3 m-3" src="{!! $image['thumbnail'] !!}">
    </div>
  @endforeach
</div>
<div class="container pb-5">
  <div class="row">
    <div class="py-3 col d-flex justify-content-center align-items-center">
      <a class="btn btn-secondary" href="{!! $gallery_page->link() !!}">View Gallery</a>
    </div>
  </div>
</div>
