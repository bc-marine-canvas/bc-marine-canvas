<?php

namespace App\Controllers;

use BC\Posts\Post;
use Sober\Controller\Controller;

class Single extends Controller {
  protected $template = 'single';

  public function post() {
    global $wp_query;

    return new Post($wp_query->post->ID);
  }
}
