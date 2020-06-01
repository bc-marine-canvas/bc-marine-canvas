<?php

namespace App;

// Add <body> classes
add_filter('body_class', function (array $classes) {
  // Add the preload class on every request
  $classes[] = 'preload';

  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add "archive-<post type>" class for custom post type archives
  if (is_post_type_archive()) {
    $post_type_archive_class = get_query_var('post_type');

    if (!in_array($post_type_archive_class, $classes)) {
      $classes[] = "archive-{$post_type_archive_class}";
    }
  }

  if (get_post_type() == 'post') {
    $classes[] = 'blog';
  }

  // Add class if sidebar is active
  if (display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  // Add class if page has a gallery
  $has_gallery = [
    'gallery',
    'home',
    'single-canvas',
  ];

  foreach ($has_gallery as $class) {
    if (in_array($class, $classes)) {
      $classes[] = 'gallery-viewer';
    }
  }

  /** Clean up class names for custom templates */
  $classes = array_map(function ($class) {
    return preg_replace(
      [
        '/-blade(-php)?$/',
        '/^page-template-views/', ],
        '',
        $class
      );
  }, $classes);

  return array_filter($classes);
});

// Add "… Continued" to the excerpt
add_filter('excerpt_more', function () {
  $permalink = get_permalink();

  return " &hellip; <a href=\"{$permalink}\">" .
    __('More', 'bc') . '</a>';
});

// Template Hierarchy should search for .blade.php files
collect([
  'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date',
  'home', 'frontpage', 'page', 'paged', 'search', 'single', 'singular',
  'attachment',
])->map(function ($type): void {
  add_filter(
    "{$type}_template_hierarchy",
    __NAMESPACE__ . '\\filter_templates'
  );
});

// Render page using Blade
add_filter('template_include', function ($template) {
  $data = collect(get_body_class())->reduce(
    function ($data, $class) use ($template) {
      return apply_filters("sage/template/{$class}/data", $data, $template);
    },
    []
  );

  if ($template) {
    echo template($template, $data);

    return get_stylesheet_directory() . '/index.php';
  }
  return $template;
}, PHP_INT_MAX);

// Render comments.blade.php
add_filter('comments_template', function ($comments_template) {
  $comments_template = str_replace(
    [get_stylesheet_directory(), get_template_directory()],
    '',
    $comments_template
  );

  $data = collect(get_body_class())->reduce(
    function ($data, $class) use ($comments_template) {
      return apply_filters(
        "sage/template/{$class}/data",
        $data,
        $comments_template
      );
    },
    []
  );

  $theme_template = locate_template(
    ["views/{$comments_template}",
    $comments_template, ]
  );

  if ($theme_template) {
    echo template($theme_template, $data);

    return get_stylesheet_directory() . '/index.php';
  }

  return $comments_template;
}, 100);

// Hide ACF field group menu item in production
if (WP_ENV === 'production') {
  add_filter('acf/settings/show_admin', '__return_false');
}

add_filter('acf/fields/wysiwyg/toolbars', function($toolbars) {
  $toolbars['Minimal'] = [];
  $toolbars['Minimal'][1] = [
    'bold',
    'italic',
    'underline',
    'link',
    'bullist',
    'numlist',
    'outdent',
    'indent',
    'spellchecker',
    'fullscreen',
  ];

  $toolbars['Extra Minimal'] = [];
  $toolbars['Extra Minimal'][1] = [
    'bold',
    'italic',
    'link',
    'spellchecker',
    'fullscreen',
  ];

  return $toolbars;
});

/**
 * Show the sidebar.
 */
add_filter('sage/display_sidebar', function ($display) {
  static $display;

  isset($display) || $display = in_array(true, [
    is_home(),
    is_singular_post_type('post'),
  ]);

  return $display;
});

/**
 * Show a map instead of a page banner.
 */
add_filter('sage/display_map_banner', function ($display) {
  static $display;

  isset($display) || $display = in_array(true, [
    is_page('contact-us'),
  ]);

  return $display;
});

/**
 * Only show published posts in ACF Relationship fields.
 */
add_filter('acf/fields/relationship/query',
  function($options, $field, $the_post) {
    $options['post_status'] = ['publish'];

    return $options;
  },
10, 3);

/**
 * Only show published posts in ACF page link fields.
 */
add_filter('acf/fields/page_link/query',
  function($options, $field, $the_post) {
    $options['post_status'] = ['publish'];

    return $options;
  },
10, 3);

/**
 * Use relative page links when the URL contains "bcmarinecanvas".
 */
add_filter('acf/format_value/type=link',
  function($value, $post_id, $field) {
    if (!is_array($value)) {
      return $value;
    }

    if (stripos($value['url'], 'bcmarinecanvas') === false) {
      return $value;
    }

    $value['url'] = preg_replace('#^https?://[^/]*#', '', $value['url']);

    return $value;
  },
20, 3);

/**
 * Remove John Huebner's reasonable request for donations. Sorry John, thank you
 * for your open-source contributions.
 */
add_filter('remove_hube2_nag', '__return_true');
