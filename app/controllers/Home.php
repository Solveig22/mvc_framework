<?php

class Home extends Controller{

    public function index() {

        $db = Database::getInstance();
        $this->view->render($this->request);
    }

    public function loadModel($model) {
        $file = APP.DS.'models'.DS.ucfirst($model).'.php';

        if(file_exists($file)) {
            $this->$model = new $model;
        }else {
            die("Le model spécifié est introuvable!");
        }

    }

}