<?php

namespace App;

// Admin assets
add_action('admin_enqueue_scripts', function () {
  wp_enqueue_style(
    'sage/admin.css',
    asset_path('styles/admin.css'),
    false,
    null
  );

  wp_enqueue_script(
    'scripts/admin.js',
    asset_path('scripts/admin.js'),
    ['jquery'],
    null,
    true
  );
}, PHP_INT_MAX);

// Theme customizer
add_action(
  'customize_register',
  function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
      'selector' => '.brand',
      'render_callback' => function () {
        bloginfo('name');
      },
    ]);

    // Remove sections/controls from the customizer
    $wp_customize->remove_panel('widgets');
    $wp_customize->remove_section('custom_css');
    $wp_customize->remove_control('site_icon');
  }
);

// Customizer JS
add_action('customize_preview_init', function () {
  wp_enqueue_script(
    'sage/customizer.js',
    asset_path('scripts/customizer.js'),
    ['customize-preview'],
    null,
    true
  );
});

// Ensure ACF Pro is installed and active
add_action('setup_theme', function () {
  $function_to_verify = 'acf_add_options_page';

  if (!function_exists($function_to_verify)) {
    $title = 'ACF Pro is required';
    $message = 'This theme depends on ACF Pro - install ACF Pro to continue.';

    wp_die($title, $message);
  }
}, 0);

// Add ACF options pages
add_action('admin_menu', function () {
  $parent = create_parent_options_page();
  create_child_options_pages($parent);
});

function create_parent_options_page() {
  $args = [
    'page_title' => 'Options',
    'menu_title' => 'Theme Options',
    'menu_slug' => 'options',
    'capability' => 'edit_posts',
    'position' => '75.5',
    'icon_url' => 'dashicons-info',
    'redirect' => true,
  ];

  return acf_add_options_page($args);
}

function create_child_options_pages($parent) {
  $parent_slug = $parent['menu_slug'];

  $sub_pages = [
    [
      'page_title' => 'Theme Options',
      'menu_title' => 'Theme Options',
      'parent_slug' => $parent_slug,
    ],
    [
      'page_title' => 'Header',
      'menu_title' => 'Header',
      'parent_slug' => $parent_slug,
    ],
    [
      'page_title' => 'Footer',
      'menu_title' => 'Footer',
      'parent_slug' => $parent_slug,
    ],
    [
      'page_title' => 'Search',
      'menu_title' => 'Search',
      'parent_slug' => $parent_slug,
    ],
    [
      'page_title' => 'Company Info',
      'menu_title' => 'Company Info',
      'parent_slug' => $parent_slug,
    ],
    [
      'page_title' => 'Social Media',
      'menu_title' => 'Social Media',
      'parent_slug' => $parent_slug,
    ],
  ];

  foreach ($sub_pages as $page) {
    acf_add_options_sub_page($page);
  }
}

function disable_gutenberg_editor($can_edit, $post_type) {
  $post_id = ($_GET['post'] ?? '');
  $pages_with_editor_hidden = (get_field('opt_hide_editor', 'options') ?? []);

  if (is_admin() && !empty($post_id)) {
    if (in_array($post_id, $pages_with_editor_hidden)) {
      $can_edit = false;
    }
  }

  return $can_edit;
}

add_filter(
  'gutenberg_can_edit_post_type',
  __NAMESPACE__ . '\\disable_gutenberg_editor',
  10,
  2
);

add_filter(
  'use_block_editor_for_post_type',
  __NAMESPACE__ . '\\disable_gutenberg_editor',
  10,
  2
);

add_action('admin_head', function() {
  global $post;
  global $pagenow;

  if (!($pagenow == 'post.php')) {
    return;
  }

  $post_id = ($_GET['post'] ?? $_POST['post_ID'] ?? '');
  $pages_with_editor_hidden = (get_field('opt_hide_editor', 'options') ?? []);

  if (is_admin() && !empty($post_id)) {
    if (in_array($post_id, $pages_with_editor_hidden)) {
      remove_post_type_support('page', 'editor');
    }
  }
});


// Remove 'Uploaded to' column from the Media Library grid view
add_filter('manage_media_columns', function($columns) {
  unset($columns['parent']);

  return $columns;
});
