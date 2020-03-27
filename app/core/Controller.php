<?php

namespace Enway\App\Core;

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

    public function loadModel($model) {
        $file = APP.DS.'models'.DS.ucfirst($model).'.php';

        if(file_exists($file)) {
            $model = strtolower($model);
            $model = "Enway\\App\\Models\\" . $model;
            $this->$model = new $model;
        }else {
            die("Le model spécifié est introuvable!");
        }

    }

}