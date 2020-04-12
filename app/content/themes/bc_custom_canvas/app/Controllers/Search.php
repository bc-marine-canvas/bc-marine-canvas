<?php

namespace App\Controllers;

use App\Models\Query;
use BC\Posts\Post;
use Sober\Controller\Controller;

class Search extends Controller {
  protected $template = 'search';

  public function search_terms() {
    global $wp_query;

    return get_query_var('s');
  }

  public function matches_count() {
    global $wp_query;

    return $wp_query->found_posts;
  }

  public function match_or_matches() {
    $string = 'matches';

    if ($this->matches_count() < 2) {
      $string = 'match';
    }

    return $string;
  }

  public function results() {
    global $wp_query;

    $wp_query = (new Query())->execute();

    return array_map(function ($id) {
      return new Post($id);
    }, $wp_query->posts);
  }

  public function search_banner() {
    $banner = get_field('opt_search_banner', 'options');

    return wp_get_attachment_image_url($banner, 'full');
  }
}
