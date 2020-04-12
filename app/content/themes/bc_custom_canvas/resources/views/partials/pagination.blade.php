<div class="row">
  <div class="col d-flex align-items-center justify-content-center my-4">
    <nav aria-label="Posts pagination">
      <ul class="pagination">
        @foreach (App::show_pagination() as $link)
          {!! $link !!}
        @endforeach
      </ul>
    </nav>
  </div>
</div>
