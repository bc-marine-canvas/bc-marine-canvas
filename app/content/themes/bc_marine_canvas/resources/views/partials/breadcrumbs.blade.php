<div class="breadcrumbs-wrapper py-2 border-bottom border-light">
  <div class="container">
    <div class="d-flex align-items-center">
      @if ($has_breadcrumbs)
        <nav aria-label="breadcrumb">
          <ol class="bg-transparent breadcrumb mb-0">
            @foreach ($breadcrumbs as $breadcrumb)
              @if (!$loop->last)
                <li class="breadcrumb-item">
                  <a href="{!! $breadcrumb['url'] !!}">{!! $breadcrumb['title'] !!}</a>
                </li>
              @else
                <li class="breadcrumb-item active" aria-current="page">{!! $breadcrumb['title'] !!}</li>
              @endif
            @endforeach
          </ol>
        </nav>
      @endif
    </div>
  </div>
</div>
