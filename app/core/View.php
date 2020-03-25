<?php

/**
 * View
 * 
 * Permet de charger la bonne vue pour le controller
 * 
 */
class View {

    protected $head;
    protected $body;
    protected $outputBuffer;
    protected $layout = 'default';
    protected $page_title = DEFAULT_PAGE_TITLE;
    protected $datas = array();


    public function render($request) {
        $file = APP.DS.'views'.DS.strtolower($request->controller).DS.$request->action.'.php';
        if(file_exists($file)) {
            extract($this->datas);
            require_once($file);
            require_once(APP.DS.'views'.DS.'layouts'.DS.$this->layout.'.php');
        }else {
            die("La page demandé n'éxiste pas!" . $file);
        }
    }


    public function content($type) {
        if($type === 'head') {
            return $this->head;
        }else if($type === 'body') {
            return $this->body;
        }
    }

    public function start($type) {
        $this->outputBuffer = $type;
        if($type === 'head' || $type === 'body') {
            ob_start();
        }else {
            die("Le paramètre spécifié dans la fonction start est inconnue!");
        }
    }

    public function end() {
        if($this->outputBuffer === 'head') {
            $this->head = ob_get_clean();
        }else if($this->outputBuffer === 'body') {
            $this->body = ob_get_clean();
        }else {
            die("Veuillez démarrer la méthode start au préalable!");
        }
    }
    
        
    /**
     * set
     * 
     * Permet d'envoyé des données à la vue
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function set($key, $value) {
        $this->datas[$key] = $value;
    }

    public function layout() {
        return $this->layout;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function page_title() {
        return $this->page_title;
    }

    public function setTitle($title) {
        $this->page_title = $title;
    }


}