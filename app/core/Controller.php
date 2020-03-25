<?php

/**
 * Controller
 */
class Controller {

    public $request;
    public $view;

    public function __construct($request) {
        $this->request = $request;
        $this->view = new View;
    }

}