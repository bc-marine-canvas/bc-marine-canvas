<?php

namespace App\Models;

class ContactPage {
  private $id;
  private $banner;
  private $intro;
  private $address_card;
  private $form_id;

  public function __construct() {
    $this->id = get_page_by_path('contact')->ID ?? '';
    $this->set_banner();
    $this->set_intro();
    $this->set_address_card();
    $this->set_form_id();
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
    return $this->intro;
  }

  public function address_card() {
    return $this->address_card;
  }

  public function form() {
    return $this->build_form(['id' => $this->form_id]);
  }

  private function set_banner() {
    $this->banner = get_field('page_banner', $this->id);
  }

  private function set_intro() {
    $this->intro = get_field('contact_intro', $this->id);
  }

  private function set_address_card() {
    $this->address_card = get_field('contact_card', $this->id);
  }

  private function set_form_id() {
    $this->form_id = get_field('contact_form', $this->id)['form_id'];
  }

  private function build_form($form_args) {
    $defaults = [
      'id' => '',
      'show_title' => false,
      'show_description' => false,
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
