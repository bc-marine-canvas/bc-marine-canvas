<?php

namespace App\Controllers;

use App\Models\Query;
use BC\Posts\Post;
use BC\Posts\PostsPage;
use Sober\Controller\Controller;

class Author extends Controller {
  protected $template = 'author';

  public static function find($id = '') {
    return new Post($id);
  }

  public function posts() {
    global $wp_query;

    $author_id = $this->extract_authors();
    $args = [];

    if ($author_id) {
      $args['author'] = $author_id;
    }

    $wp_query = (new Query($args))->execute();

    return array_map(function ($id) {
      return new Post($id);
    }, $wp_query->posts);
  }

  public function author() {
    global $wp_query;

    $author_id = $wp_query->query['author'] ?? '';

    if ($author_id) {
      $author['name'] = get_the_author_meta('display_name', $author_id);
    }

    return $author;
  }

  protected function extract_authors() {
    global $wp_query;

    return get_query_var('author') ?? '';
  }

  protected function id() {
    $object = get_queried_object();

    return ($object ? $object->ID : '');
  }
}
