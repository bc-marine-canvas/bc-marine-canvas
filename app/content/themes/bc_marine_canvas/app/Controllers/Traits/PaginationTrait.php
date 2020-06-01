<?php

namespace App\Controllers\Traits;

trait PaginationTrait {
  public static function show_pagination() {
    global $wp_query;

    $big_int = 999999998;
    $url = esc_url(get_pagenum_link($big_int));

    $args = [
      'base' => str_replace($big_int, '%#%', $url),
      'format' => '/page/%#%',
      'current' => max(1, get_query_var('page')),
      'total' => $wp_query->max_num_pages,
      'type' => 'array',
      'prev_text' => 'Previous',
      'next_text' => 'Next',
    ];

    $pagination = self::bootstrapify(paginate_links($args));

    wp_reset_query();

    return $pagination;
  }

  private static function bootstrapify($paginated_links) {
    $links = [];

    array_map(function ($link) use (&$links) {
      $bootstrapped_link = '';
      $active = (strpos($link, 'current') !== false ? true : false);

      $li = self::build_li_tag($link, $active);
      $a = str_replace('page-numbers', 'page-link text-uppercase', $link);

      $bootstrapped_link .= "<{$li}>{$a}</li>";

      $links[] = $bootstrapped_link;
    }, (array) $paginated_links);

    return $links;
  }

  private static function build_li_tag($link, $active) {
    $li = 'li class="page-item ';

    if ($active) {
      $li .= 'active" aria-current="page"';
    } else {
      $li .= '"';
    }

    return $li;
  }
}
