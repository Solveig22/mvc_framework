<?php

namespace Enway\App\Controller;

use Enway\App\Core\Controller;
use Enway\App\Core\Database;

class Home extends Controller{

    public function index() {

        $db = Database::getInstance();
        
        
        $this->loadModel('Article');
        
        $this->view->render($this->request);
    }


}