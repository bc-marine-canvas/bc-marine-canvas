<div class="container mt-5 section-with-products">
  <div class="row">
    <div class="col">
      <h2 class="mb-4">{{ $content['heading'] }}</h2>
      <div class="mw-575">
        {!! $content['text'] !!}
      </div>
      <h3 class="mt-4 mb-3">{{ $content['suggested']['subheading'] }}</h3>
      <ul class="list-unstyled d-flex justify-content-start align-items-center">
        @foreach ($content['suggested']['products'] as $product)
          <li class="m-3">
            <div class="card">
              <img class="card-img-top" src="{{ $product['image'] }}" alt="{{ $product['name'] }} product image">
              <div class="card-body text-center">
                <a class="stretched-link" href="{{ $product['link'] }}">{{ $product['name'] }}</a>
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  @if (!$loop->last)
    <hr>
  @endif
</div>
