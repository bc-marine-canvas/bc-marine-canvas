<?php

namespace App\Controllers;

use App\Models\CustomPage;
use Sober\Controller\Controller;

class Custom extends Controller {
  protected $template = 'custom';

  public function custom_page() {
    return new CustomPage((get_queried_object())->ID);
  }
}
