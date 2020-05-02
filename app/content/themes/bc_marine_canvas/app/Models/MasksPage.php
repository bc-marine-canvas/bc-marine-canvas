<?php

namespace App\Models;

class MasksPage {
  private $id;
  private $banner;
  private $intro_copy;
  private $checklist;
  private $tabs_copy;
  private $tabs;
  private $form_id;

  public function __construct() {
    $this->id = get_page_by_path('masks')->ID ?? '';
    $this->set_banner();
    $this->set_intro_copy();
    $this->set_checklist();
    $this->set_tabs_copy();
    $this->set_tabs();
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

  public function intro_copy() {
    $copy = $this->intro_copy;

    $id = $copy['image']['id'];
    $url = wp_get_attachment_image_url($id, 'large');

    $copy['image']['url'] = $url;

    return $copy;
  }

  public function checklist() {
    $checklist = $this->checklist;

    $id = $checklist['image']['id'];
    $url = wp_get_attachment_image_url($id, 'large');

    $checklist['image']['url'] = $url;

    return $checklist;
  }

  public function tabs_copy() {
    return $this->tabs_copy;
  }

  public function tabs() {
    return $this->tabs;
  }

  public function form() {
    return $this->build_form(['id' => $this->form_id]);
  }

  private function set_banner() {
    $this->banner = get_field('page_banner', $this->id);
  }

  private function set_intro_copy() {
    $this->intro_copy = get_field('masks_intro_copy', $this->id);
  }

  private function set_checklist() {
    $this->checklist = get_field('masks_checklist', $this->id);
  }

  private function set_tabs_copy() {
    $copy = [];

    $copy['heading'] =
      get_field('masks_tabbed_content', $this->id)['heading'];

    $this->tabs_copy = $copy;
  }

  private function set_tabs() {
    $tabs = [];

    while (have_rows('masks_tabbed_content')) {
      the_row();

      while (have_rows('tabs')) {
        the_row();

        $tab = get_sub_field('tab');
        $content = get_sub_field('content');

        $tabs[] = [
          'tab' => [
            'id' => Helpers::dasherize($tab['heading']),
            'heading' => $tab['heading'],
            'icon' => $tab['icon'],
          ],
          'content' => [
            'image' => [
              'url' => $content['image']['url'],
              'alt' => $content['image']['alt'],
            ],
            'heading' => $content['heading'],
            'text' => $content['text'],
          ],
        ];
      }
    }

    $this->tabs = $tabs;
  }

  private function set_form_id() {
    $this->form_id = get_field('masks_cta', $this->id)['form_id'];
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
