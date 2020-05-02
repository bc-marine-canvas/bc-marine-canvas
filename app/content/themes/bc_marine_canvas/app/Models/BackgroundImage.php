<?php

namespace App\Models;

class BackgroundImage {
  private const DATA_ATTRIBUTE_BASE = 'data-inline-style';
  private const STYLE_NAME = 'sage/embed';

  private $uid = '';
  private $is_asset = false;
  private $pseudo_classes = [];
  private $pseudo_elements = [];
  private $only_pseudo_selectors = false;
  private $path = '';
  private $data_attribute = '';
  private $base_selector = '';
  private $selectors = '';
  private $declaration = '';
  private $style_rule = '';

  public function __construct($path = '', $options = []) {
    $this->set_uid();
    $this->set_is_asset($options);
    $this->set_pseudo_selectors($options);
    $this->set_path($path);
    $this->set_data_attribute();
    $this->set_base_selector();
    $this->set_selectors();
    $this->set_declaration();
    $this->set_style_rule();
  }

  public function data_attribute() {
    return $this->data_attribute;
  }

  public function embed_css() {
    if (!$this->style_rule) {
      return;
    }

    wp_register_style(self::STYLE_NAME, false);
    wp_enqueue_style(self::STYLE_NAME);
    wp_add_inline_style(self::STYLE_NAME, $this->style_rule);
  }

  private function set_uid() {
    $this->uid = 'style-' . uniqid();
  }

  private function set_is_asset($options) {
    if (!isset($options['asset'])) {
      return;
    }

    $this->is_asset = ($options['asset'] ? true : false);
  }

  private function set_pseudo_selectors($options) {
    if (isset($options['pseudo_classes'])) {
      $this->pseudo_classes = (array) $options['pseudo_classes'];
    }

    if (isset($options['pseudo_elements'])) {
      $this->pseudo_elements = (array) $options['pseudo_elements'];
    }

    if (isset($options['only_pseudo_selectors'])) {
      $this->only_pseudo_selectors = $options['only_pseudo_selectors'];
    }
  }

  private function set_path($path) {
    if (!$path) {
      return;
    }

    $this->path = ($this->is_asset ? \App\asset_path($path) : $path);
  }

  private function set_data_attribute() {
    $this->data_attribute = self::DATA_ATTRIBUTE_BASE . "=" . $this->uid;
  }

  private function set_base_selector() {
    $this->base_selector = "[$this->data_attribute]";
  }

  private function set_selectors() {
    $selectors = [];

    if (!$this->only_pseudo_selectors) {
      $selectors[] = $this->base_selector;
    }

    array_map(function ($pseudo_class) use (&$selectors) {
      $selectors[] = "$this->base_selector:$pseudo_class";
    }, $this->pseudo_classes);

    array_map(function ($pseudo_element) use (&$selectors) {
      $selectors[] = "$this->base_selector::{$pseudo_element}";
    }, $this->pseudo_elements);

    $this->selectors = implode(', ', $selectors);
  }

  private function set_declaration() {
    $this->declaration = "background-image: url('$this->path')";
  }

  private function set_style_rule() {
    $this->style_rule = "$this->selectors { $this->declaration }";
  }
}
