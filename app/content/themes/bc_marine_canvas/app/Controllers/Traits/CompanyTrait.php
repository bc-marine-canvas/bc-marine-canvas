<?php

namespace App\Controllers\Traits;

trait CompanyTrait {
  public function company_name() {
    return get_field('opt_company_name', 'options');
  }

  public function company_contact() {
    $info = get_field('opt_company_contact_info', 'options');

    $phone['href'] = "tel:{$info['phone']['e164']}";
    $phone['display'] = $this->to_phone_format($info['phone']['national']);

    return [
      'phone' => $phone,
      'email' => $info['email'],
    ];
  }

  public function company_address() {
    $address = get_field('opt_company_address', 'options');

    $address['directions_link'] = $this->build_directions_link($address);

    return $address;
  }

  public function company_social_media() {
    return get_field('opt_social_media_links', 'option');
  }

  private function to_phone_format($number = '') {
    $unwanted_characters = [' ', '-'];

    $number = str_replace($unwanted_characters, '', $number);
    $number = substr_replace($number, '(', 0, 0);
    $number = substr_replace($number, ')', 4, 0);
    $number = substr_replace($number, ' ', 5, 0);
    $number = substr_replace($number, '-', 9, 0);

    return $number;
  }

  private function build_directions_link($address) {
    $location = $address['address_line_1'];

    if ($address['address_line_2']) {
      $location .= ", {$address['address_line_2']}";
    }

    $location .= ", {$address['city']}";
    $location .= ", {$address['state']}";
    $location .= " {$address['zip_code']}";

    return $this->google_maps_link($location);
  }

  private function google_maps_link($location) {
    $address = urlencode($location);

    return "https://www.google.com/maps/dir/?api=1&destination=$address";
  }
}
