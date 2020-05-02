<div class="hero-container" @background("{$home_page->hero()['image']['url']}")>
  <div class="row no-gutters py-6">
    <div class="col d-flex flex-column align-items-center justify-content-center">
      <div class="hero-title-opacity w-100">
        <div class="container py-3">
          <div class="row">
            <div class="col">
              <h1 class="hero">{{ $home_page->hero()['heading'] }}</h1>
            </div>
          </div>
        </div>
      </div>
      <p class="mt-5">
        <a class="btn btn-primary hero-link" href="{!! $home_page->hero()['link'] !!}">{{ $home_page->hero()['button_text'] }}</a>
      </p>
    </div>
  </div>
</div>
