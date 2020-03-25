<?php

/**
 * Request
 * 
 * Permet de récuper l'url demandé Controller/Action/Param1/Param2/...
 * 
 */
class Request {

    public $url;

    public function __construct() {
        $this->url = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '';
    }

}