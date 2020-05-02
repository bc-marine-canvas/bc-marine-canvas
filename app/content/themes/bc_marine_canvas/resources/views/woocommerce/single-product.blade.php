@extends('layouts.app')

@section('banner', App::background_image($products_page->banner()))

@section('content')
  <div class="container mt-4" role="document">
    @php
      do_action('get_header', 'shop');
    @endphp

    @while(have_posts())
      @php
        the_post();
        do_action('woocommerce_shop_loop');
        wc_get_template_part('content', 'single-product');
      @endphp
    @endwhile

    @php
      do_action('get_sidebar', 'shop');
      do_action('get_footer', 'shop');
    @endphp
  </div>
@endsection