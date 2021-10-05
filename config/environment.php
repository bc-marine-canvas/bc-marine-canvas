<?php

use Dotenv\Dotenv;

// Define project paths
define('ROOT_DIR', '/var/www');
define('DOC_ROOT_DIR', '/var/www/app');
define('CONFIG_DIR', '/var/www/config');
define('ENV_DIR', '/var/www/config/environments');
define('ENV_FILE', '/var/www/config/.env');
define('CONTENT_DIR', '/var/www/app/content');

// Load environment variables
$env = Dotenv::createUnsafeImmutable(CONFIG_DIR);
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
  'AUTH_KEY',
  'SECURE_AUTH_KEY',
  'LOGGED_IN_KEY',
  'NONCE_KEY',
  'AUTH_SALT',
  'SECURE_AUTH_SALT',
  'LOGGED_IN_SALT',
  'NONCE_SALT',
]);

// WordPress configuration
define('WP_HOME', getenv('WP_HOME_URL'));
define('WP_SITEURL', getenv('WP_SITE_URL'));

define('CONTENT_URL', WP_HOME . '/content');
define('WP_CONTENT_DIR', CONTENT_DIR);
define('WP_CONTENT_URL', CONTENT_URL);
define('MU_PLUGIN_DIR', CONTENT_DIR . '/mu-plugins');

// Database configuration
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST'));
define('DB_CHARSET', getenv('DB_CHARSET'));
define('DB_COLLATE', getenv('DB_COLLATE'));
$table_prefix = getenv('DB_TABLE_PREFIX');

// AWS S3 configuration
define('S3_UPLOADS_BUCKET', getenv('S3_UPLOADS_BUCKET'));
define('S3_UPLOADS_KEY', getenv('S3_UPLOADS_KEY'));
define('S3_UPLOADS_SECRET', getenv('S3_UPLOADS_SECRET'));
define('S3_UPLOADS_REGION', getenv('S3_UPLOADS_REGION'));

// Salts
define('AUTH_KEY', getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY'));
define('NONCE_KEY', getenv('NONCE_KEY'));
define('AUTH_SALT', getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', getenv('LOGGED_IN_SALT'));
define('NONCE_SALT', getenv('NONCE_SALT'));

// Miscellaneous configuration
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', false);
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);

// SSL configuration
define('FORCE_SSL_ADMIN', true);

// Query monitor configuration.
define('QM_DARK_MODE', true);

$protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
if ($protocol === 'https') {
  $_SERVER['HTTPS'] = 'on';
}

// Environment-specific configuration
define('WP_ENV', getenv('WP_ENV') ?: 'development');
$config_filename = WP_ENV . '.php';
$config_file = ENV_DIR . "/${config_filename}";

require_once $config_file;

// Define `ABSPATH`.
if (!defined('ABSPATH')) {
 define('ABSPATH', WP_SITEURL . '/');
}
