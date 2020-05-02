<?php

namespace App\Models;

class Product {
  private $id;
  private $banner;

  public function __construct($id) {
    $this->id = $id ?? '';
    $this->set_banner();
  }

  public function id() {
    return $this->id;
  }

  public function name() {
    return get_the_title($this->id);
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
