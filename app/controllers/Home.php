<?php

class Home extends Controller{

    public function index() {

        $db = Database::getInstance();

        $articles = $db->findFirst('articles');
        dump($articles);
        $this->view->render($this->request);
    }

}