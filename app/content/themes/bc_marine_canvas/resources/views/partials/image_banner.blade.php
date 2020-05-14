<div class="page-banner-image" @yield('banner', App::default_banner())>
  <div class="page-banner-opacity">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="page-banner">@yield('title', App::title())</h1>
        </div>
      </div>
    </div>
  </div>
</div>
