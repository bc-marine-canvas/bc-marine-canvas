<?php

namespace App\Controllers\Traits;

trait MenuTrait {
  public static function main_nav() {
    return wp_nav_menu([
      'theme_location' => 'main_nav',
      'menu_class' => 'navbar-nav ml-auto d-none d-lg-flex',
    ]);
  }

  public static function mobile_nav() {
    return wp_nav_menu([
      'theme_location' => 'mobile_nav',
      'menu_class' => 'navbar-nav ml-auto d-lg-none',
    ]);
  }

  public static function top_bar_nav() {
    return wp_nav_menu([
      'theme_location' => 'top_bar_nav',
      'menu_class' => 'navbar-nav',
    ]);
  }

  public static function color_variant() {
    return 'dark';
  }

  public function brand_logo() {
    $image = get_field('opt_header_logo', 'options')['id'];

    return wp_get_attachment_image_url($image, 'full');
  }
}
