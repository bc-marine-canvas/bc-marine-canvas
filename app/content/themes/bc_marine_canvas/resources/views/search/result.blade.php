<article class="rounded">
  <div class="mx-auto card post-card search-result">
    <div class="card-body post-card-body d-flex flex-column justify-content-between">
      <div class="d-flex align-items-center">
        <h2 class="search pb-0 mb-0 entry-title mr-auto">
          <a href="{{ $post->link() }}">{{ $post->title() }}</a>
        </h2>
        <h3 class="ml-3 px-2 mb-0 badge badge-primary text-uppercase">
          @php
            $post_type = str_replace('_', ' ', get_post_type($post->id()));

            if ($post_type == 'post') {
              $post_type = 'blog';
            }

            echo $post_type;
          @endphp
        </h3>
      </div>
      @if (get_post_type($post->id()) == 'post')
        <div class="mt-2">
          @include('partials.entry_meta')
        </div>
      @endif
    </div>
  </div>
</article>
