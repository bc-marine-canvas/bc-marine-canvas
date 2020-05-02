<?php

namespace App\Models;

use BC\Canvas\Service as CanvasService;
use BC\Canvas\Services as CanvasServices;
use BC\Upholstery\Service as UpholsteryService;
use BC\Upholstery\Services as UpholsteryServices;

class GalleryPage {
  private $id;
  private $banner;
  private $intro_copy;

  public static function images() {
    $attachment_ids = [];

    foreach (CanvasServices::all() as $service) {
      $ids = CanvasService::find_related_attachments($service->name());
      $attachment_ids = array_merge($ids, $attachment_ids);
    }

    foreach (UpholsteryServices::all() as $service) {
      $ids = UpholsteryService::find_related_attachments($service->name());
      $attachment_ids = array_merge($ids, $attachment_ids);
    }

    return array_unique($attachment_ids);
  }

  public function __construct() {
    $this->id = get_page_by_path('gallery')->ID ?? '';
    $this->set_banner();
    $this->set_intro();
  }

  public function id() {
    return $this->id;
  }

  public function name() {
    return get_the_title($this->id);
  }

  public function link() {
    return get_page_link($this->id);
  }

  public function banner($size = 'full') {
    return wp_get_attachment_image_url($this->banner, $size);
  }

  public function intro() {
    return $this->intro_copy;
  }

  private function set_banner() {
    $this->banner = get_field('page_banner', $this->id);
  }

  private function set_intro() {
    $this->intro_copy = get_field('gallery_page_intro', $this->id)['text'];
  }
}
