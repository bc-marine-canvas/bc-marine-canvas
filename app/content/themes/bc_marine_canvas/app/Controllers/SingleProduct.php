<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use App\Models\Product;

class SingleProduct extends Controller {
  use Traits\ArchivePageTrait;

  protected $template = 'single-product';

  public function product() {
    return new Product((get_queried_object())->ID);
  }
}
