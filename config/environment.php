<?php

use Dotenv\Dotenv;

/**
 * Define project paths.
 */
define('ROOT_DIR', '/var/www');
define('DOC_ROOT_DIR', '/var/www/app');
define('CONFIG_DIR', '/var/www/config');
define('ENV_DIR', '/var/www/config/environments');
define('ENV_FILE', '/var/www/config/.env');

/**
 * Load environment variables.
 * See https://github.com/vlucas/phpdotenv for more information.
 */
$env = Dotenv::createImmutable(CONFIG_DIR);
$env->load();
$env->required([
  'SITE_NAME',
  'WP_ENV',
  'WP_HOME_URL',
  'WP_SITE_URL',
  'DB_NAME',
  'DB_USER',
  'DB_PASSWORD',
  'DB_HOST',
  'DB_CHARSET',
  'DB_COLLATE',
  'DB_TABLE_PREFIX',
  'S3_UPLOADS_BUCKET',
  'S3_UPLOADS_KEY',
  'S3_UPLOADS_SECRET',
  'S3_UPLOADS_REGION',
]);

// Define WordPress paths.
define('WP_HOME', getenv('WP_HOME_URL'));
define('WP_SITEURL', getenv('WP_SITE_URL'));

define('CONTENT_DIR', '/var/www/app/content');
define('CONTENT_URL', WP_HOME . '/content');
define('WP_CONTENT_DIR', CONTENT_DIR);
define('WP_CONTENT_URL', CONTENT_URL);

// Database configuration.
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST'));
define('DB_CHARSET', getenv('DB_CHARSET'));
define('DB_COLLATE', getenv('DB_COLLATE'));
$table_prefix = getenv('DB_TABLE_PREFIX');

// AWS S3 configuration.
define('S3_UPLOADS_BUCKET', getenv('S3_UPLOADS_BUCKET'));
define('S3_UPLOADS_KEY', getenv('S3_UPLOADS_KEY'));
define('S3_UPLOADS_SECRET', getenv('S3_UPLOADS_SECRET'));
define('S3_UPLOADS_REGION', getenv('S3_UPLOADS_REGION'));

// Miscellaneous configuration.
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', false);
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);

// Google Maps API configuration.
define('GOOGLE_MAPS_KEY', getenv('GOOGLE_MAPS_KEY'));

// Force SSL.
define('FORCE_SSL_ADMIN', true);

/**
 * Protocol detection.
 */
$protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';

if ($protocol === 'https') {
  $_SERVER['HTTPS'] = 'on';
}

/**
 * Environment-specific configuration.
 *
 * Set the global environment constant (default value is `development`). Then,
 * load the configuration file for the specified environment.
 */
define('WP_ENV', getenv('WP_ENV') ?: 'development');
$config_filename = WP_ENV . '.php';
$config_file = ENV_DIR . "/${config_filename}";

require_once $config_file;

// Define `ABSPATH`.
if (!defined('ABSPATH')) {
 define('ABSPATH', WP_SITEURL . '/');
}
