<div class="container pt-5">
  <div class="row">
    <div class="col text-center">
      <h2>{{ $masks_page->tabs_copy()['heading'] }}</h2>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col">
      <ul class="nav nav-pills flex-column flex-sm-row align-items-stretch justify-content-around masks-tabs" id="trade-partner-tabs" role="tablist">
        @foreach ($masks_page->tabs() as $tab)
          <li class="nav-item w-100">
            <a class="h-100 text-center nav-link masks-tab @if ($loop->first) active @endif" href="#trade-partner-tabs-{{ $tab['tab']['id'] }}" id="trade-partner-tabs-{{ $tab['tab']['id'] }}-tab" data-toggle="pill" role="tab" aria-controls="trade-partner-tabs-{{ $tab['tab']['id'] }}" @if ($loop->first) aria-selected="true" @endif>
              @svg("{$tab['tab']['icon']['url']}", ['asset' => false])
              <p class="mb-0 font-weight-bold text-uppercase">{{ $tab['tab']['heading'] }}</p>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
<div class="masks-panes">
  <div class="tab-content">
    @foreach ($masks_page->tabs() as $tab)
      <div class="tab-pane fade show @if ($loop->first) active @endif" id="trade-partner-tabs-{{ $tab['tab']['id'] }}" role="tabpanel" aria-labelledby="trade-partner-tabs-{{ $tab['tab']['id'] }}-tab">
        <div class="container">
          <div class="row py-5">
            @if ($tab['content']['image']['url'])
              <div class="col-lg-4 px-5 py-3">
                <div class="text-center">
                  <img class="img-fluid" src="{{ $tab['content']['image']['url'] }}" alt="{{ $tab['content']['image']['alt'] }}">
                </div>
              </div>
            @endif
            @if ($tab['content']['image']['url'])
              <div class="col-lg-8 px-5 py-3 d-flex flex-column justify-content-center masks-pane-content">
            @else
              <div class="col-10 offset-1 px-5 py-3 d-flex flex-column justify-content-center masks-pane-content">
            @endif
              <h3 class="mb-3">{{ $tab['content']['heading'] }}</h3>
              {!! $tab['content']['text'] !!}
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
