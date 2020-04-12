<?php

namespace App\Controllers\Traits;

trait BreadcrumbTrait {
  public function breadcrumbs() {
    return get_crumbs();
  }

  public function has_breadcrumbs() {
    return (count(get_crumbs()) > 1 ? true : false);
  }
}
