<?php

define('DEBUG', 0);

define('LAYOUT', 'luxury');

define('ROOT', dirname(__DIR__));
define('WWW', ROOT . '/public');
define('APP', ROOT . '/app');
define('CONFIG', ROOT . '/config');
define('CORE', ROOT . '/vendor/luxury/core');
define('LIBS', ROOT . '/vendor/luxury/core/libs');
define('CACHE', ROOT . '/tmp/cache');

$app_path = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace("#[^/]+$#", '', $app_path);
$app_path = str_replace("/public/", '', $app_path);

define('PATH', $app_path);
define('ADMIN', PATH . '/admin');

require_once ROOT . '/vendor/autoload.php';
