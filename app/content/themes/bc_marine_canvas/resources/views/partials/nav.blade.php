<nav class="navbar navbar-expand-lg navbar-{!! App::color_variant() !!} bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="{{ home_url('/') }}">
      <img class="mw-100" src="{!! $brand_logo !!}" alt="{{ $company_name['trade'] }} logo">
      <span class="sr-only">{{ $company_name['trade'] }} logo</span>
    </a>
    <button class="float-right navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle main navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse search-relative main-nav {!! App::color_variant() !!}" id="main-nav">
      @if (has_nav_menu('main_nav')) {{ App::main_nav() }} @endif
      @if (has_nav_menu('mobile_nav')) {{ App::mobile_nav() }} @endif

      <!-- xs only -->
      <form class="d-lg-none form-inline my-0 search-form" method="get" action="/">
        <label class="sr-only" for="navbar-reveal-search-input">
          Search
        </label>
        <div class="input-group search-field-wrapper">
          <input class="form-control search-field" type="text" name="s" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-transparent-dark search-button" type="submit">
              @svg('images/icons/magnifying-glass.svg')
            </button>
          </div>
        </div>
      </form>

      <!-- lg and up -->
      <form class="d-none d-lg-flex form-inline search-form my-0 search-form" method="get" action="/">
        <label class="sr-only" for="navbar-reveal-search-input">
          Search
        </label>
        <div class="input-group search-field-wrapper">
          <input class="form-control search-field collapsed" id="navbar-reveal-search-input" type="text" name="s" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-transparent-{!! App::color_variant() !!} search-button" id="toggle-search-button" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle search form">
              @svg('images/icons/magnifying-glass.svg')
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>

