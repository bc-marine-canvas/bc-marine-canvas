@extends('layouts.app')

@section('banner', App::background_image($products_page->banner()))
@section('title', $products_page->name())

@section('content')
  <div class="container mt-4" role="document">
    @php
      do_action('get_header', 'shop');
    @endphp

    <header class="woocommerce-products-header">
      @php
        do_action('woocommerce_archive_description');
      @endphp
    </header>

    @if(woocommerce_product_loop())
      @php
        do_action('woocommerce_before_shop_loop');
        woocommerce_product_loop_start();
      @endphp

      @if(wc_get_loop_prop('total'))
        @while(have_posts())
          @php
            the_post();
            do_action('woocommerce_shop_loop');
            wc_get_template_part('content', 'product');
          @endphp
        @endwhile
      @endif

      @php
        woocommerce_product_loop_end();
        do_action('woocommerce_after_shop_loop');
      @endphp
    @else
      @php
        do_action('woocommerce_no_products_found');
      @endphp
    @endif

    @php
      do_action('woocommerce_after_main_content');
      do_action('get_sidebar', 'shop');
      do_action('get_footer', 'shop');
    @endphp
  </div>
@endsection