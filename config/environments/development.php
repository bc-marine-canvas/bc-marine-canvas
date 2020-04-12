<?php

/**
 * Development-specific configuration.
 */
ini_set('display_errors', 'stderr');
ini_set('error_reporting', E_ALL);
ini_set('allow_url_include', 1);

define('SAVEQUERIES', true);
define('SCRIPT_DEBUG', true);
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
