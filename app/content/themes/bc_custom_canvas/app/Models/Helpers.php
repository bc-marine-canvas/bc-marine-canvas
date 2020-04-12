<?php

namespace App\Models;

class Helpers {
  public static function dasherize($string) {
    $formatted_string = strtolower($string);
    $formatted_string = str_replace(' ', '-', $formatted_string);

    return $formatted_string;
  }
}
