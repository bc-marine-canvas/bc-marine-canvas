<div class="row no-gutters">
  <div class="col-md-6 order-1 d-flex justify-content-end">
    <div class="p-5 masks-main-copy d-flex flex-column justify-content-center">
      <h2 class="mb-3">{{ $masks_page->intro_copy()['heading'] }}</h2>
      {!! $masks_page->intro_copy()['text'] !!}
      <a class="mt-3 btn btn-secondary archive-row" href="{{ $masks_page->intro_copy()['link']['url'] }}">{{ $masks_page->intro_copy()['link']['title'] }}</a>
    </div>
  </div>
  <div class="col-md-6 order-2">
    <div class="masks-main-img" @background("{$masks_page->intro_copy()['image']['url']}")>&nbsp;</div>
  </div>
</div>
