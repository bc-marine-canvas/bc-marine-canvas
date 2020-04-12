<?php

namespace App\Controllers\Traits;

use App\Models\AboutPage;
use App\Models\ContactPage;
use App\Models\GalleryPage;
use App\Models\MasksPage;
use BC\Canvas\ServicesPage as CanvasServicesPage;
use BC\Posts\PostsPage;
use BC\Upholstery\ServicesPage as UpholsteryServicesPage;

trait ArchivePageTrait {
  public function about_page() {
    return new AboutPage();
  }

  public function canvas_page() {
    return new CanvasServicesPage();
  }

  public function contact_page() {
    return new ContactPage();
  }

  public function gallery_page() {
    return new GalleryPage();
  }

  public function masks_page() {
    return new MasksPage();
  }

  public function posts_page() {
    return new PostsPage();
  }

  public function upholstery_page() {
    return new UpholsteryServicesPage();
  }
}
