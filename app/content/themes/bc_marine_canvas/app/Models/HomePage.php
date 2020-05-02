<?php

namespace App\Models;

use App\Models\GalleryPage;
use App\Models\MasksPage;
use BC\Canvas\ServicesPage as CanvasServicesPage;
use BC\Upholstery\ServicesPage as UpholsteryServicesPage;

class HomePage {
  private $id;
  private $hero;
  private $services_copy;
  private $services;
  private $gallery_copy;
  private $gallery;
  private $form_id;

  public function __construct() {
    $this->id = get_option('page_on_front') ?? '';
    $this->set_hero();
    $this->set_services_copy();
    $this->set_gallery_copy();
    $this->set_gallery();
    $this->set_form_id();
  }

  public function hero() {
    return $this->hero;
  }

  public function services_copy() {
    return $this->services_copy;
  }

  public function services() {
    $canvas_page = new CanvasServicesPage();
    $upholstery_page = new UpholsteryServicesPage();
    $masks_page = new MasksPage();

    return [
      'canvas' => [
        'name' => $canvas_page->name(),
        'image' => $canvas_page->intro_copy()['image'],
        'link' => $canvas_page->link(),
      ],
      'upholstery' => [
        'name' => $upholstery_page->name(),
        'image' => $upholstery_page->intro_copy()['image'],
        'link' => $upholstery_page->link(),
      ],
      'masks' => [
        'name' => $masks_page->name(),
        'image' => $masks_page->intro_copy()['image']['url'],
        'link' => $masks_page->link(),
      ],
    ];
  }

  public function gallery_copy() {
    return $this->gallery_copy;
  }

  public function gallery() {
    return $this->gallery;
  }

  public function form() {
    return $this->build_form(['id' => $this->form_id]);
  }

  private function set_hero() {
    $hero = get_field('home_hero_image', $this->id);

    $hero['image']['url'] =
      wp_get_attachment_image_url($hero['image']['id'], 'full');

    $this->hero = $hero;
  }

  private function set_services_copy() {
    $services_copy = get_field('home_services', $this->id);

    $this->services_copy = [
      'heading' => $services_copy['heading'],
      'subheading' => $services_copy['subheading'],
    ];
  }

  private function set_gallery_copy() {
    $gallery_copy = get_field('home_gallery', $this->id);

    $this->gallery_copy = [
      'heading' => $gallery_copy['heading'],
      'button_text' => $gallery_copy['button_text'],
      'link' => $gallery_copy['link'],
    ];
  }

  private function set_gallery() {
    $attachment_ids = GalleryPage::images();

    $posts = get_posts([
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'post__in' => $attachment_ids,
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => 12,
    ]);

    $this->gallery = array_map(function ($post) {
      return [
        'thumbnail' => wp_get_attachment_image_url($post->ID, 'large'),
        'full' => wp_get_attachment_image_url($post->ID, 'full'),
      ];
    }, $posts);
  }

  private function set_form_id() {
    $this->form_id = get_field('home_cta', $this->id)['form_id'];
  }

  private function build_form($form_args) {
    $defaults = [
      'id' => '',
      'show_title' => true,
      'show_description' => true,
      'show_inactive' => false,
      'field_values' => false,
      'ajax' => true,
      'tabindex' => null,
      'echo' => false,
    ];

    $args = $form_args + $defaults;

    return gravity_form(...array_values($args));
  }
}
