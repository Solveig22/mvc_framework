<?php

define('DS', DIRECTORY_SEPARATOR);
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', dirname(dirname(__FILE__)));
define('APP', ROOT.DS.'app');
define('CORE', APP.DS.'core');

require_once(APP.DS.'config'.DS.'config.php');
require_once(APP.DS.'config'.DS.'helpers'.DS.'functions.php');

function my_autoload($className) {
    if(file_exists(CORE.DS.$className.'.php')) {
        require_once(CORE.DS.$className.'.php');
    }else if(file_exists(APP.DS.'controllers'.DS.$className.'.php')) {
        require_once(APP.DS.'controllers'.DS.$className.'.php');
    }else if(APP.DS.'models'.DS.$className.'.php') {
        require_once(APP.DS.'models'.DS.$className.'.php');
    }
}

spl_autoload_register('my_autoload');

new Dispatcher;