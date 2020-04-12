<?php

namespace App\Controllers;

use App\Models\HomePage;
use Sober\Controller\Controller;

class FrontPage extends Controller {
  public function home_page() {
    return new HomePage($this->id());
  }

  private function id() {
    $object = get_queried_object();

    return ($object ? $object->ID : '');
  }
}
