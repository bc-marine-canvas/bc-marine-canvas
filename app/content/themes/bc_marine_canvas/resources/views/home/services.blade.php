<div class="container py-6 home-services">
  <div class="row d-flex align-items-center justify-content-center text-center">
    <h2>{{ $home_page->services_copy()['heading'] }}</h2>
    <div class="w-100"></div>
    <p class="mw-575 mb-lg-5">{{ $home_page->services_copy()['subheading'] }}</p>
  </div>
  <div class="row">
    @foreach ($home_page->services() as $key => $service)
      <div class="col-md-6 my-3 my-lg-0">
        <a class="h-100 p-0 btn card-title archive-card-link" href="{!! $service['link'] !!}">
          <div class="h-100 mx-auto card rounded-0 bg-transparent">
            <div class="d-block card-img-top archive-card-img" @background("{$service['image']}")></div>
            <div class="card-body justify-content-center archive-card-body border-top border-white d-flex align-items-center">
              <p class="m-0 px-3">{{ $service['name'] }}</p>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
</div>
