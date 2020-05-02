<?php

namespace App\Controllers;

use App\Models\MasksPage;
use Sober\Controller\Controller;

class PageMasks extends Controller {
  protected $template = 'page-masks';

  public function masks_page() {
    return new MasksPage();
  }
}
