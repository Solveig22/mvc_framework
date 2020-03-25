<?php

/**
 * Dispatcher
 * 
 * La classe Dispatcher de charger le bon controller
 * 
 */
class Dispatcher {

    public $request;

    public function __construct() {
        $this->request = new Request();
        Router::parse($this->request);
        $this->loadController();
    }

    
    /**
     * Instancie le controller correspondant à la page demandé
     *
     * @return void
     */
    public function loadController() {

        $controller = ucfirst($this->request->controller);

        $file = APP . DS . 'controllers' . DS . $controller . '.php';

        if (file_exists($file)) {
            $controller = new $controller($this->request);

            if (method_exists($this->request->controller, $this->request->action)) {
                call_user_func_array(array($controller, $this->request->action), $this->request->params);
            } else {
                die("Le controller " . $this->request->controller . " ne possède pas de méthode " . $this->request->action);
            }
        } else {
            die("Le fichier " . $file . " est introuvable!");
        }
    }
}
