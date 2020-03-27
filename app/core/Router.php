<?php

namespace Enway\App\Core;

/**
 * Router
 * 
 * Permet de parser l'url et de redirigé l'utilisateur vers la bonne page
 * 
 */
class Router {
    
    /**
     * parse
     * 
     * Parse l'url en un tableau contenant le controller, la méthode ainsi que les paramèteres
     * 
     * @param  mixed $request $request->url contient l'url
     * @return void crée de nouveaux attribus pour l'objet request (controller, action, paramètres)
     */
    public static function parse($request) {
        $url = explode('/', trim($request->url, '/'));

        $request->controller =  (isset($url[0]) && !empty($url[0])) ? array_shift($url) : DEFAULT_CONTROLLER;
        $request->action = (isset($url[0]) && !empty($url[0])) ? array_shift($url) : 'index';
        $request->params = $url;

        return true;
    }

}