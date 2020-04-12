<?php

namespace App\Controllers;

use BC\Upholstery\Service as UpholsteryService;
use Sober\Controller\Controller;

class SingleUpholstery extends Controller {
  use Traits\ArchivePageTrait;

  protected $template = 'single-upholstery_service';

  public function service() {
    return new UpholsteryService((get_queried_object())->ID);
  }
}
