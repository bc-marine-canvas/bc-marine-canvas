<?php

namespace App\Controllers\Traits;

trait HeaderTrait {
  public function top_bar_cta() {
    return get_field('opt_top_bar_cta', 'options');
  }
}
