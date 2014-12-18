<?php
    ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $file = __DIR__.'/../../vendor/autoload.php';
    if (!file_exists($file)) {
        throw new RuntimeException('Install dependencies to run test suite.');
    }
    $autoload = require_once $file;