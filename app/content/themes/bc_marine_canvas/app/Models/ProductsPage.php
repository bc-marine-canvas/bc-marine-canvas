<?php

namespace App\Models;

class ProductsPage {
  private $id;
  private $banner;

  public function __construct() {
    $this->id = get_page_by_path('shop')->ID ?? '';
    $this->set_banner();
  }

  public function id() {
    return $this->id;
  }

  public function name() {
    return woocommerce_page_title(false);
  }

  public function link() {
    return get_page_link($this->id);
  }

  public function banner($size = 'full') {
    return wp_get_attachment_image_url($this->banner, $size);
  }

  private function set_banner() {
    $this->banner = get_field('page_banner', $this->id);
  }
}
