<?php

// List the ACF field group key and path to the ACF JSON directory for each
// additional ACF JSON save location.
//
// Example:
//
//   return [
//     'posts' => [
//       'group' => 'group_123abc',
//       'path' => WP_CONTENT_DIR . '/mu-plugins/posts/acf-json/',
//     ],
//   ];

  return [
    'posts' => [
      'group' => 'group_5c379aa0ee5e3',
      'path' => WP_CONTENT_DIR . '/mu-plugins/posts/acf-json/',
    ],
    'posts_page' => [
      'group' => 'group_5c63afe829d98',
      'path' => WP_CONTENT_DIR . '/mu-plugins/posts/acf-json/',
    ],
    'canvas' => [
      'group' => 'group_5e44f959b3c55',
      'path' => WP_CONTENT_DIR . '/mu-plugins/bc-canvas/acf-json/',
    ],
    'canvas_page' => [
      'group' => 'group_5e575695086d7',
      'path' => WP_CONTENT_DIR . '/mu-plugins/bc-canvas/acf-json/',
    ],
    'upholstery' => [
      'group' => 'group_5e6d323d819a1',
      'path' => WP_CONTENT_DIR . '/mu-plugins/bc-upholstery/acf-json/',
    ],
    'upholstery_page' => [
      'group' => 'group_5e6d32b59aefa',
      'path' => WP_CONTENT_DIR . '/mu-plugins/bc-upholstery/acf-json/',
    ],
  ];
