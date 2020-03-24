<?php

class Router {

    public static function parse($request) {
        $url = explode('/', trim($request->url, '/'));

        $request->controller =  (isset($url[0]) && !empty($url[0])) ? array_shift($url) : DEFAULT_CONTROLLER;
        $request->action = (isset($url[0]) && !empty($url[0])) ? array_shift($url) : 'index';
        $request->params = $url;

        return true;
    }

}