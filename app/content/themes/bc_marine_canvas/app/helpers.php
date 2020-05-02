<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string    $abstract
 * @param array     $parameters
 * @param Container $container
 *
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null) {
  $container = $container ?: Container::getInstance();
  if (!$abstract) {
    return $container;
  }

  return $container->bound($abstract)
    ? $container->makeWith($abstract, $parameters)
    : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of
 * values.
 *
 * @param array|string $key
 * @param mixed        $default
 *
 * @return mixed|\Roots\Sage\Config
 *
 * @copyright Taylor Otwell
 *
 * @see https://github.com/laravel/framework/blob/c0970285/src/Illuminate
 *   /Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null) {
  if ($key === null) {
    return sage('config');
  }
  if (is_array($key)) {
    return sage('config')->set($key);
  }
  return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array  $data
 *
 * @return string
 */
function template($file, $data = []) {
  if (!is_admin() && remove_action('wp_head', 'wp_enqueue_scripts', 1)) {
    wp_enqueue_scripts();
  }

  return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view.
 *
 * @param $file
 * @param array $data
 *
 * @return string
 */
function template_path($file, $data = []) {
  return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 *
 * @return string
 */
function asset_path($asset) {
  return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 *
 * @return array
 */
function filter_templates($templates) {
  $paths = apply_filters('sage/filter_templates/paths', [
    'views',
    'resources/views',
  ]);
  $paths_pattern = '#^(' . implode('|', $paths) . ')/#';

  return collect($templates)
    ->map(function ($template) use ($paths_pattern) {
      /** Remove .blade.php/.blade/.php from template names */
      $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

      // Remove partial $paths from the beginning of template names
      if (mb_strpos($template, '/')) {
        $template = preg_replace($paths_pattern, '', $template);
      }

      return $template;
    })
    ->flatMap(function ($template) use ($paths) {
      return collect($paths)
        ->flatMap(function ($path) use ($template) {
          return [
            "{$path}/{$template}.blade.php",
            "{$path}/{$template}.php",
          ];
        })
        ->concat([
          "{$template}.blade.php",
          "{$template}.php",
        ]);
    })
    ->filter()
    ->unique()
    ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 *
 * @return string Location of the template
 */
function locate_template($templates) {
  return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar.
 *
 * @return bool
 */
function display_sidebar() {
  static $display;
  isset($display) || $display = apply_filters('sage/display_sidebar', false);
  return $display;
}

/**
 * Check for a singular post type.
 *
 * @param string $post_type_slug The slug of the post type
 * @return bool
 */
function is_singular_post_type($post_type_slug) {
  $is_post_type = (get_post_type() == $post_type_slug ? true : false);
  $is_singular = is_singular();

  return ($is_post_type && $is_singular);
}

/**
 * Determine if a map should be shown instead of a page banner.
 *
 * @return bool
 */
function display_map_banner() {
  static $display;

  isset($display) || $display = apply_filters('sage/display_map_banner', false);

  return $display;
}

/**
 * Post data to be passed to the browser via `wp_localize_script`.
 *
 * @return array The data
 */
function post_data() {
  $data = [];

  $data['id'] = get_the_ID();
  $data['title'] = page_title();

  return $data;
}

/**
 * Returns the title for the current page.
 *
 * @param $post \WP_Post The current post
 * @return string The title
 */
function page_title() {
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

  return get_the_title();
}

/**
 * Returns the full path to an asset.
 *
 * @param $asset The relative path to an asset
 * @return string The full path to the asset
 */
function locate_asset($asset) {
  return trailingslashit(config('assets.path')) . sage('assets')->get($asset);
}
