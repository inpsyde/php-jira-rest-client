<?php

if (!defined('TEST_BASE_DIR')) {
    define('TEST_BASE_DIR', dirname(__DIR__));
}

if (!defined('PROJECT_BASE_DIR')) {
    define('PROJECT_BASE_DIR', dirname(__DIR__, 1));
}

if (!defined('PROJECT_VENDOR_DIR')) {
    define('PROJECT_VENDOR_DIR', rtrim(PROJECT_BASE_DIR, '/') . '/vendor/');
}

require_once rtrim(PROJECT_VENDOR_DIR, '/') . '/autoload.php';

if (file_exists(PROJECT_BASE_DIR . '/.env.phpunit')) {
    $dotenv = Dotenv\Dotenv::createImmutable(PROJECT_BASE_DIR, '.env.phpunit');
    $dotenv->load();
}
