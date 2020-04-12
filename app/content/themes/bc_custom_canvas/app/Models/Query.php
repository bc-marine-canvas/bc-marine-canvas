<?php

namespace App\Models;

class Query {
  private const POSTS_PER_PAGE = 12;

  private $post_type;
  private $post_status;
  private $post_in;
  private $tax_query;
  private $year;
  private $month;
  private $p;
  private $limit;
  private $page;
  private $offset;
  private $search;
  private $order_by;
  private $order;
  private $fields;
  private $filtered_by;
  private $force_posts_in;

  public function __construct($options = []) {
    $options = $options + $this->defaults();

    $this->post_type = $options['post_type'];
    $this->post_status = $options['post_status'] ?? 'publish';
    $this->post_in = $options['post_in'] ?? [];
    $this->year = $options['year'];
    $this->month = $options['month'];
    $this->p = $options['p'] ?? '';
    $this->limit = $options['limit'];
    $this->order_by = $options['order_by'];
    $this->order = $options['order'];
    $this->fields = $options['fields'];
    $this->tax_query = $options['tax_query'] ?? [];
    $this->filtered_by = $options['filtered_by'] ?? [];
    $this->force_posts_in = $options['force_posts_in'];

    $this->search = $this->set_search();
    $this->page = $this->set_page();
    $this->offset = $this->set_offset();
  }

  public function execute() {
    $query_args = [
      'post_type' => $this->post_type,
      'post_status' => $this->post_status,
      'post__in' => $this->post_in,
      'posts_per_page' => $this->limit,
      'page' => $this->page,
      'offset' => $this->offset,
      'orderby' => $this->order_by,
      'order' => $this->order,
      'tax_query' => $this->tax_query,
      'year' => $this->year,
      'monthnum' => $this->month,
    ];

    if ($this->p) {
      $query_args['p'] = $this->p;
    }

    if ($this->filtered_by) {
      $query_args['post__in'] = $this->filtered_by + $query_args['post__in'];
    }

    if ($this->search) {
      $query_args = [
        'posts_per_page' => $this->limit,
        'page' => $this->page,
        'offset' => $this->offset,
        'orderby' => $this->order_by,
        'order' => $this->order,
        's' => $this->search,
      ];
    }

    // Force WP_Query to use the post__in field, even if it's an empty array.
    // Link to issue is here: https://core.trac.wordpress.org/ticket/28099.
    if ($this->force_posts_in) {
      if (count($query_args['post__in']) == 0) {
        $query_args['post__in'] = array(0);
      }
    }

    return new \WP_Query($query_args);
  }

  private function defaults() {
    return [
      'post_type' => 'post',
      'post_in' => [],
      'tax_query' => [],
      'year' => '',
      'month' => '',
      'limit' => self::POSTS_PER_PAGE,
      'offset' => 0,
      'order_by' => 'date',
      'order' => 'desc',
      'fields' => 'ids',
      'filtered_by' => [],
      'force_posts_in' => false,
    ];
  }

  private function set_page() {
    global $paged;

    return (get_query_var('paged') ? absint(get_query_var('paged')) : 1);
  }

  private function set_offset() {
    return ($this->page - 1) * $this->limit;
  }

  private function set_search() {
    return (get_query_var('s') ?: false);
  }
}
