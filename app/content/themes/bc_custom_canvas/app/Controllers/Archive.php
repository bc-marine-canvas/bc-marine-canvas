<?php

namespace App\Controllers;

use BC\Posts\Post;
use Sober\Controller\Controller;

class Archive extends Controller {
  protected $template = 'archive';

  public function posts() {
    global $wp_query;

    return array_map(function ($post) {
      return new Post($post->ID);
    }, $wp_query->posts);
  }
}
