<?php

namespace App\Controllers;

use App\Models\Query;
use BC\Upholstery\Service as UpholsteryService;
use Sober\Controller\Controller;

class ArchiveUpholstery extends Controller {
  use Traits\ArchivePageTrait;

  protected $template = 'archive-upholstery_service';

  public function services() {
    global $wp_query;

    $wp_query = (new Query([
      'post_type' => 'upholstery_service',
      'order_by' => 'menu_order',
      'order' => 'ASC',
      'limit' => -1,
    ]))->execute();

    return array_map(function ($post_id) {
      return new UpholsteryService($post_id);
    }, $wp_query->posts);
  }

  public static function find($id = '') {
    return new UpholsteryService($id);
  }
}
