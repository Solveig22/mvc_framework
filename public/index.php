<?php

use Enway\App\Core\Dispatcher;

define('DS', DIRECTORY_SEPARATOR);
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', dirname(dirname(__FILE__)));
define('APP', ROOT.DS.'app');
define('CORE', APP.DS.'core');

require_once(APP.DS.'config'.DS.'config.php');
require_once(APP.DS.'config'.DS.'helpers'.DS.'functions.php');
require_once(ROOT.DS.'vendor'.DS.'autoload.php');

new Dispatcher;