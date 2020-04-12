<?php

/**
 * Production-specific configuration.
 */
ini_set('display_errors', 'stderr');
ini_set('error_reporting', E_ALL);

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('ACF_LITE', true);
