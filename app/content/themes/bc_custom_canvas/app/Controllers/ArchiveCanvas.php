<?php

namespace App\Controllers;

use App\Models\Query;
use BC\Canvas\Service as CanvasService;
use Sober\Controller\Controller;

class ArchiveCanvas extends Controller {
  use Traits\ArchivePageTrait;

  protected $template = 'archive-canvas_service';

  public function services() {
    global $wp_query;

    $wp_query = (new Query([
      'post_type' => 'canvas_service',
      'order_by' => 'menu_order',
      'order' => 'ASC',
      'limit' => -1,
    ]))->execute();

    return array_map(function ($post_id) {
      return new CanvasService($post_id);
    }, $wp_query->posts);
  }

  public static function find($id = '') {
    return new CanvasService($id);
  }
}
