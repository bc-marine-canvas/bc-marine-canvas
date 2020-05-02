<?php

namespace App\Models;

class AboutPage {
  private $id;
  private $banner;
  private $main_copy;

  public function __construct() {
    $this->id = get_page_by_path('about')->ID ?? '';
    $this->set_banner();
    $this->set_main_copy();
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

  public function main_copy() {
    $copy = $this->main_copy;

    $id = $copy['image'];
    $url = wp_get_attachment_image_url($id, 'large');

    $copy['image'] = $url;

    return $copy;
  }

  private function set_banner() {
    $this->banner = get_field('page_banner', $this->id);
  }

  private function set_main_copy() {
    $this->main_copy = get_field('about_main_copy', $this->id) ?? '';
  }
}
