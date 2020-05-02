@foreach ($services as $service)
  @if ($loop->iteration % 2)
    <div class="row no-gutters py-6">
      <div class="col">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-lg-8 pl-5 d-flex flex-column justify-content-center">
              <h3>{{ $service->name() }}</h3>
              <p class="mt-4 pr-2 mw-575">{!! $service->summary() !!}</p>
              <a class="mt-3 btn btn-secondary archive-row" href="{!! $service->link() !!}">Learn More</a>
            </div>
            <div class="d-none d-lg-block col-lg-4 text-center">
              <img class="img-fluid archive-row" src="{!! $service->card_image() !!}">
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="row no-gutters py-6 bg-gray">
      <div class="col">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="d-none d-lg-block col-lg-4 text-center">
              <img class="img-fluid archive-row" src="{!! $service->card_image() !!}">
            </div>
            <div class="col-lg-8 pl-5 d-flex flex-column justify-content-center">
              <h3>{{ $service->name() }}</h3>
              <p class="mt-4 pr-2 mw-575">{!! $service->summary() !!}</p>
              <a class="mt-3 btn btn-secondary archive-row" href="{!! $service->link() !!}">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endforeach
