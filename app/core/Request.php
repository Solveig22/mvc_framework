<?php

class Request {

    public $url;

    public function __construct() {
        $this->url = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '';
    }

}