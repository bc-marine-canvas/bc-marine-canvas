<?php

namespace App\Controllers;

use App\Models\Query;
use BC\Posts\Post;
use BC\Posts\PostsPage;
use Sober\Controller\Controller;

class Home extends Controller {
  protected $template = 'home';

  public static function find($id = '') {
    return new Post($id);
  }

  public function posts() {
    global $wp_query;

    $wp_query = (new Query())->execute();

    return array_map(function ($id) {
      return new Post($id);
    }, $wp_query->posts);
  }

  public function posts_page() {
    return new PostsPage();
  }
}
