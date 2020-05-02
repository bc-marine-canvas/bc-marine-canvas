<?php

namespace App;

function favicon_path($icon) {
  return asset_path("images/favicons/$icon");
}

// phpcs:disable
function load_favicon() {
  $html = '
<link rel="apple-touch-icon" sizes="180x180" href="' . favicon_path("apple-touch-icon.png") . '?v=69BGzoWdwZ">
<link rel="icon" type="image/png" sizes="32x32" href="' . favicon_path("favicon-32x32.png") . '?v=69BGzoWdwZ">
<link rel="icon" type="image/png" sizes="16x16" href="' . favicon_path("favicon-16x16.png") . '?v=69BGzoWdwZ">
<link rel="manifest" href="' . favicon_path("site.webmanifest") . '?v=69BGzoWdwQ">
<link rel="mask-icon" href="' . favicon_path("safari-pinned-tab.svg") . '?v=69BGzoWdwQ" color="#007cbb">
<link rel="shortcut icon" href="' . favicon_path("favicon.ico") . '?v=69BGzoWdwQ">
<meta name="msapplication-TileColor" content="#ffc40d">
<meta name="theme-color" content="#4d4d4d">';

  echo $html;
}
add_action('wp_head', __NAMESPACE__ . '\\load_favicon');
add_action('admin_head', __NAMESPACE__ . '\\load_favicon');
// phpcs:enable
