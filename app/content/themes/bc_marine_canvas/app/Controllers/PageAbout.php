<?php

namespace App\Controllers;

use App\Models\AboutPage;
use Sober\Controller\Controller;

class PageAbout extends Controller {
  protected $template = 'page-about';

  public function about_page() {
    return new AboutPage();
  }
}
