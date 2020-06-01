<?php

namespace App\Models;

class CustomPage {
  private $id;
  private $banner;
  private $content;

  public function __construct($page_id = '') {
    $this->id = $page_id;
    $this->set_banner();
    $this->set_content();
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

  public function content() {
    return $this->content;
  }

  private function set_banner() {
    $this->banner = get_field('page_banner', $this->id);
  }

  private function set_content() {
    $content = [];

    while (have_rows('custom_content')) {
      the_row();

      while (have_rows('blocks')) {
        the_row();

        $block = [];

        if (get_row_layout() == 'section_with_products') {
          $block['type'] = 'section_with_products';

          $heading = get_sub_field('heading');
          $text = get_sub_field('text');
          $suggested = get_sub_field('suggested') ?? [];

          $products = array_map(function ($product_id) {
            return [
              'name' => get_the_title($product_id),
              'image' => get_the_post_thumbnail_url($product_id, 'medium'),
              'link' => get_permalink($product_id),
            ];
          }, $suggested['products']);

          $block['content'] = [
            'heading' => $heading,
            'text' => $text,
            'suggested' => [
              'subheading' => $suggested['subheading'],
              'products' => $products,
            ],
          ];

          $content[] = $block;
        }
      }
    }

    $this->content = $content;
  }
}
