<?php

namespace App\Models;

class Filter {
  private const FILTERABLE_POST_TYPES = [
    'BC\Canvas\CanvasPostType',
    'BC\Upholstery\UpholsteryPostType',
  ];

  private const FILTERABLE_CLASSES = [
    'canvas' => 'BC\Canvas\Service',
    'upholstery' => 'BC\Upholstery\Service',
  ];

  private const RELATIONSHIP_KEYS = [
    'canvas' => [
      'upholstery' => 'relation_canvas_upholstery',
    ],
    'upholstery' => [
      'canvas' => 'relation_canvas_upholstery',
    ],
  ];

  public static function applied_filters() {
    return array_filter(self::filter_query_args(), function($filter_arg) {
      return isset($_GET[$filter_arg]);
    });
  }

  public static function filtered_ids() {
    if (get_queried_object()->post_name == 'gallery') {
      return self::filtered_attachment_ids();
    } else {
      return self::filtered_post_ids();
    }
  }

  public static function filtered_attachment_ids() {
    $ids = [];

    foreach (self::applied_filters() as $filter) {
      $type = substr($filter, 0, -3);
      $class = self::FILTERABLE_CLASSES[$type];

      $object = new $class($_GET[$filter]);
      $related_ids = $class::find_related_attachments($object->name());

      if ($ids == []) {
        $ids = $related_ids;
      } else {
        $ids = array_intersect($ids, $related_ids);
      }
    }

    return $ids;
  }

  public static function filtered_post_ids() {
    $posts = get_posts([
      'post_type' => self::return_type(),
      'posts_per_page' => -1,
      'meta_query' => self::filter_meta_query(),
    ]) ?? [];

    return array_map(function ($post) {
      return $post->ID;
    }, $posts);
  }

  public static function for($type) {
    $class = self::FILTERABLE_CLASSES[$type];

    $posts = get_posts([
      'post_type' => "{$type}_service",
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'orderby' => 'name',
      'order' => 'ASC',
    ]) ?? [];

    return array_map(function ($post) use ($class) {
      $object = new $class($post->ID);

      return [
        'id' => $object->id(),
        'name' => $object->name(),
      ];
    }, $posts);
  }

  public static function filter_values() {
    return array_map(function ($filter) {
      return $_GET[$filter];
    }, self::applied_filters());
  }

  private static function filter_query_args() {
    return array_map(function ($filterable_class) {
      return $filterable_class::ID . "-id";
    }, self::FILTERABLE_POST_TYPES);
  }

  private static function return_type() {
    $post_type = get_queried_object();

    return ($post_type ? $post_type->name : '');
  }

  private static function filter_meta_query() {
    $return_type = self::return_type();
    $meta_query = [];

    foreach (self::applied_filters() as $filter) {
      $type = substr($filter, 0, -3);

      $meta_query[] = [
        'key' => self::RELATIONSHIP_KEYS[$return_type][$type],
        'value' => $_GET[$filter],
        'compare' => 'LIKE',
      ];
    }

    return $meta_query;
  }
}
