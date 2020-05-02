<?php

namespace App\Controllers;

use App\Models\Filter;
use App\Models\GalleryPage;
use App\Models\Query;
use Sober\Controller\Controller;

class PageGallery extends Controller {
  protected $template = 'page-gallery';

  public function gallery_page() {
    return new GalleryPage();
  }

  public function gallery() {
    global $wp_query;

    $attachment_ids = GalleryPage::images();

    if (Filter::applied_filters()) {
      $attachment_ids =
        array_intersect($attachment_ids, Filter::filtered_ids());
    }

    $wp_query = (new Query([
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'post_in' => $attachment_ids,
      'force_posts_in' => true,
      'order_by' => 'date',
      'order' => 'DESC',
      'limit' => 16,
    ]))->execute();

    return array_map(function ($post) {
      return [
        'thumbnail' => wp_get_attachment_image_url($post->ID, 'large'),
        'full' => wp_get_attachment_image_url($post->ID, 'full'),
      ];
    }, $wp_query->posts);
  }
}
