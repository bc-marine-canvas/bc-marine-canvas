<?php

namespace App\Controllers;

use App\Models\ContactPage;
use Sober\Controller\Controller;

class PageContact extends Controller {
  protected $template = 'page-contact';

  public function contact_page() {
    return new ContactPage();
  }
}
