<?php

namespace App\Controllers;

use App\Models\BackgroundImage;
use App\Models\Filter;
use Sober\Controller\Controller;

class App extends Controller {
  use Traits\BreadcrumbTrait;
  use Traits\CompanyTrait;
  use Traits\FooterTrait;
  use Traits\HeaderTrait;
  use Traits\MenuTrait;
  use Traits\PaginationTrait;

  public static function title($custom = '') {
    if ($custom !== '') {
      return $custom;
    }

    if (is_home()) {
      if ($home = get_option('page_for_posts', true)) {
        return get_the_title($home);
      }

      return 'Latest Posts';
    }

    if (is_archive()) {
      return post_type_archive_title('', false);
    }

    if (is_search()) {
      return 'Search Results for ' . get_search_query();
    }

    if (is_404()) {
      return 'Not Found';
    }

    return html_entity_decode(get_the_title());
  }

  public static function background_image($path, $options = []) {
    $background_image = new BackgroundImage($path, $options);
    $background_image->embed_css();

    return $background_image->data_attribute();
  }

  public static function svg($path, $options = []) {
    $defaults = ['asset' => true];
    $options = $options + $defaults;

    $is_asset = ($options['asset'] ? true : false);

    if ($is_asset) {
      $path = trim($path, " '\"");

      $path = \App\locate_asset($path);
    }

    return $path;
  }

  public static function asset_file_contents($path) {
    $asset_path = \App\asset_path($path);

    die(var_dump(file_get_contents("{$asset_path}")));

    return file_get_contents($asset_path);
  }

  public static function p($data = [], $echo = false) {
    $data = (array) $data;
    $data = print_r($data, true);

    $output = '<pre style="';
    $output .= 'font-family: monospace;';
    $output .= 'margin: 20px;';
    $output .= 'padding: 10px;';
    $output .= 'background-color: #efefef;';
    $output .= 'overflow: scroll;';
    $output .= 'border: 1px solid #88c0d0;">';
    $output .= $data;
    $output .= '</pre>';

    if ($echo) {
      echo $output;
    } else {
      return $output;
    }
  }

  public static function filter_for($post_type) {
    return Filter::for($post_type);
  }

  public static function filter_values() {
    return Filter::filter_values();
  }

  public static function selected_filter($filter_key) {
    return in_array($filter_key, Filter::applied_filters());
  }
}
