<?php

if (!defined('PROJECT_DIR')) {
    define('PROJECT_DIR', dirname(__DIR__, 1));
}

if (!defined('PROJECT_VENDOR_DIR')) {
    define('PROJECT_VENDOR_DIR', rtrim(PROJECT_DIR, '/') . '/vendor/');
}

require_once rtrim(PROJECT_VENDOR_DIR, '/') . '/autoload.php';

if (file_exists(PROJECT_DIR . '/.env.phpunit')) {
    $dotenv = Dotenv\Dotenv::createImmutable(PROJECT_DIR, '.env.phpunit');
    $dotenv->load();
}
