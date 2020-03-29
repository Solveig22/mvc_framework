<?php

namespace Enway\App\Controller;

use Enway\App\Core\Controller;
use Enway\App\Core\Database;

class Home extends Controller{

    public function index() {
        $this->view->render($this->request);
    }


}