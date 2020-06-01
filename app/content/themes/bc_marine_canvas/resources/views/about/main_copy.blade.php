<div class="container py-5">
  <div class="row d-flex align-items-center">
    <div class="col-lg-6">
      <h2>{{ $about_page->main_copy()['heading'] }}</h2>
      <p>{{ $about_page->main_copy()['text'] }}</p>
    </div>
    <div class="col-lg-6 text-center supporting-image">
      <img class="img-fluid" src="{!! $about_page->main_copy()['image'] !!}" alt="{{ $about_page->name() }} supporting image">
    </div>
  </div>
</div>
