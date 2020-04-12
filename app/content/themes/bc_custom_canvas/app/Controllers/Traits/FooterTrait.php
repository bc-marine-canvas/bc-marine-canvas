<?php

namespace App\Controllers\Traits;

trait FooterTrait {
  public function footer_cta() {
    return get_field('opt_footer_cta', 'options');
  }

  public function footer_logo() {
    $logo = get_field('opt_footer_logo', 'options');

    $image_id = $logo['id'];
    $alt = $logo['alt'];

    $metadata = wp_get_attachment_metadata($image_id);

    return [
      'url' => wp_get_attachment_image_url($image_id, 'full'),
      'alt' => $alt,
      'height' => $metadata['height'],
      'width' => $metadata['width'],
    ];
  }

  public function footer_quick_links() {
    return get_field('opt_footer_links', 'options');
  }

  public function footer_contact() {
    return get_field('opt_footer_contact', 'options');
  }

  public function footer_social() {
    return get_field('opt_footer_social', 'options');
  }
}
