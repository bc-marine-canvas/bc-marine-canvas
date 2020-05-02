<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveProduct extends Controller {
  use Traits\ArchivePageTrait;

  protected $template = 'archive-product';
}
