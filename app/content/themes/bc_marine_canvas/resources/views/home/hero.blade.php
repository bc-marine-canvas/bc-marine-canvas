<div class="hero-container" @background("{$home_page->hero()['image']['url']}")>
  <div class="row no-gutters py-6">
    <div class="col d-flex flex-column align-items-center justify-content-center">
      <div class="hero-title-opacity w-100">
        <div class="container py-4 py-xl-5">
          <div class="row">
            <div class="col d-flex flex-column justify-content-center">
              <h1 class="hero">{{ $home_page->hero()['heading'] }}</h1>
              <div class="w-100"></div>
              <p class="mt-4 text-center">
                <a class="btn btn-secondary hero-link" href="{!! $home_page->hero()['link'] !!}">{{ $home_page->hero()['button_text'] }}</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
