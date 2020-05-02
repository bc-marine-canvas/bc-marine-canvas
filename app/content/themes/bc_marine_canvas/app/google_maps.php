<?php

namespace App;

function load_google_maps() {
  if (display_map_banner()) {
    wp_enqueue_script(
      'google-maps',
      "https://maps.googleapis.com/maps/api/js?key=" . GOOGLE_MAPS_KEY,
      [],
      null,
      false
    );

    wp_localize_script('google-maps', 'mapsData', maps_data());
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\load_google_maps', 99);

function maps_data() {
  $data = [];

  $data['address'] = get_field('opt_primary_address', 'options');

  return $data;
}
