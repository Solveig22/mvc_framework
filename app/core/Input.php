<?php

namespace Enway\App\Core;

class Input {

    public static function sanitize($dirty) {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }

    public static function get($name) {
        if(isset($_POST[$name])) {
            return self::sanitize($_POST[$name]);
        }else if(isset($_GET[$name])) {
            return self::sanitize($_GET[$name]);
        }
    }

}