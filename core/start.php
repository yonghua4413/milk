<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

ini_set('error_reporting', E_ALL);

define('ROOT_PATH', __DIR__ . '/../');
define('APP_PATH', ROOT_PATH . 'app/');
define('CONFIG_PATH', ROOT_PATH . 'config/');
define('RUNTIME', ROOT_PATH . 'runtime/');

define('PHP_EXT', '.php');
define('HTML_EXT', '.html');

// include_once 
$appPath = __DIR__ . '/lib/App.php';

include_once $appPath;

$app = new App();

$app->start();
