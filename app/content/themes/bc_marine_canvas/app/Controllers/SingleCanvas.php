<?php

namespace App\Controllers;

use BC\Canvas\Service as CanvasService;
use Sober\Controller\Controller;

class SingleCanvas extends Controller {
  use Traits\ArchivePageTrait;

  protected $template = 'single-canvas_service';

  public function service() {
    return new CanvasService((get_queried_object())->ID);
  }
}
