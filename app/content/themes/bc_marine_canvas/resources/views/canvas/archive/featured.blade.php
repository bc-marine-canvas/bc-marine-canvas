<div class="featured-links featured-links-bg">
  <div class="featured-links-opacity">
    <div class="container py-5">
      <div class="row">
        @if (count($services) > 3)
          <div class="col-xl-3">
            <div class="h-100 d-flex flex-column justify-content-center">
              <h2 class="mb-0 align-self-top font-weight-bold">{{ $copy['heading'] }}</h2>
              <p class="subheading">{{ $copy['subheading'] }}</p>
            </div>
          </div>
          @foreach ($services as $service)
            <div class="col-md-4 col-xl-3 py-5">
              <div class="h-100 d-flex flex-column justify-content-between align-items-center">
                <img class="rounded-circle" src="{!! $service->mini_image() !!}">
                <p class="text-uppercase">{{ $service->name() }}</p>
                <div class="mt-0 d-block mx-auto">
                  <a class="btn btn-outline-light" href="{!! $service->link() !!}">Learn More</a>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div class="col">
            <div class="h-100 d-flex flex-column justify-content-center">
              <h2 class="mb-0 align-self-top font-weight-bold">{{ $copy['heading'] }}</h2>
              <p class="subheading mb-0">{{ $copy['subheading'] }}</p>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
