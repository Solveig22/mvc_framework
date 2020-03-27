<?php

namespace Enway\App\Core;

class Cookie {

    public static function set($name, $value, $expire) {
        setcookie($name, $value, time() + $expire);
    }

    public static function delete($name) {
        self::set($name, '', -1);
    }

    public static function exists($name) {
        return isset($_COOKIE[$name]);
    }

    public static function get($name) {
        return (self::exists($name)) ? $_COOKIE[$name] : false;
    }

}