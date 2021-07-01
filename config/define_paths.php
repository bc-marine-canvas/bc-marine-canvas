<?php

// Define path constants. Allow constants to be defined locally.
if (file_exists( __DIR__ . DIRECTORY_SEPARATOR . 'path_constants.local.php')) {
  require_once 'path_constants.local.php';
} else {
  require_once 'path_constants.php';
}
