<?php

namespace App;

use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Container;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

// Theme assets
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);

  wp_enqueue_script(
    'sage/main.js',
    asset_path('scripts/main.js'),
    ['jquery'],
    null,
    true
  );

  wp_localize_script('sage/main.js', 'postData', post_data());
}, 100);

// Theme setup
add_action('after_setup_theme', function () {
  /*
   * Enable features from Soil when plugin is activated
   * @link https://roots.io/plugins/soil/
   */
  add_theme_support('soil-clean-up');
  add_theme_support('soil-disable-asset-versioning');
  add_theme_support('soil-disable-trackbacks');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-relative-urls');

  /*
   * Enable plugins to manage the document title
   * @link https://developer.wordpress.org/reference/functions
   *   /add_theme_support/#title-tag
   */
  add_theme_support('title-tag');

  /*
   * Register navigation menus
   * @link https://developer.wordpress.org/reference/functions
   *   /register_nav_menus/
   */
  register_nav_menus([
    'main_nav' => __('Main Menu', 'bc'),
    'mobile_nav' => __('Mobile Menu', 'bc'),
    'top_bar_nav' => __('Top Bar Menu', 'bc'),
  ]);

  /*
   * Enable post thumbnails
   * @link https://developer.wordpress.org/themes/functionality
   *   /featured-images-post-thumbnails/
   */
  add_theme_support('post-thumbnails');

  /*
   * Enable HTML5 markup support
   * @link https://developer.wordpress.org/reference/functions
   *   /add_theme_support/#html5
   */
  add_theme_support(
    'html5',
    [
      'caption',
      'gallery',
      'search-form',
    ]
  );

  /*
   * Enable selective refresh for widgets in customizer
   * @link https://developer.wordpress.org/themes/advanced-topics
   *   /customizer-api/#theme-support-in-sidebars
   */
  add_theme_support('customize-selective-refresh-widgets');

  /*
   * Use main stylesheet for visual editor
   * @see resources/assets/styles/layouts/_tinymce.scss
   */
  add_editor_style(asset_path('styles/main.css'));
}, 20);

// Register sidebars
add_action('widgets_init', function () {
  $config = [
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ];
  register_sidebar([
    'name' => __('Blog', 'bc'),
    'id' => 'sidebar-blog',
  ] + $config);
  register_sidebar([
    'name' => __('Landing Page', 'bc'),
    'id' => 'sidebar-landing_page',
  ] + $config);
  register_sidebar([
    'name' => __('Resources', 'bc'),
    'id' => 'sidebar-resources',
  ] + $config);
});

/*
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as
 * partials
 */
add_action('the_post', function ($post) {
  sage('blade')->share('post', $post);
});

// Setup Sage options
add_action('after_setup_theme', function () {
  // Add JsonManifest to Sage container
  sage()->singleton('sage.assets', function () {
    return new JsonManifest(config('assets.manifest'), config('assets.uri'));
  });

  // Add Blade to Sage container
  sage()->singleton('sage.blade', function (Container $app) {
    $cachePath = config('view.compiled');
    if (!file_exists($cachePath)) {
      wp_mkdir_p($cachePath);
    }
    (new BladeProvider($app))->register();
    return new Blade($app['view']);
  });

  // Create @asset() Blade directive
  sage('blade')->compiler()->directive('asset', function ($asset) {
    return '<?= ' . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
  });

  // Generate inline background image styles from inside Blade templates
  sage('blade')->compiler()->directive('background', function ($arguments) {
    $args = explode(', ', $arguments, 2);

    if (count($args) > 1) {
      list($background, $options) = explode(', ', $arguments, 2);
    } else {
      $background = $args[0];
      $options = '[]';
    }

    return '<?= ' . __NAMESPACE__ .
      "::background_image({$background}, {$options}); ?>";
  });

  // Include SVG file contents inline
  sage('blade')->compiler()->directive('svg', function ($arguments) {
    $args = explode(', ', $arguments, 2);

    if (count($args) > 1) {
      list($svg, $options) = explode(', ', $arguments, 2);
    } else {
      $svg = $args[0];
      $options = '[]';
    }

    return '<?= file_get_contents(' .
      __NAMESPACE__ . "::svg({$svg}, {$options})); ?>";
  });
});
