<?php

namespace Enway\App\Controller;

use Enway\App\Core\Controller;
use Enway\App\Core\Input;
use Enway\App\Core\Router;
use Enway\App\Core\Validate;

class Register extends Controller {

    public function __construct($request) {
        $this->loadModel('User');
        parent::__construct($request);
    }

    public function login() {
        if(isset($_POST) && !empty($_POST)) {
            $validation = new Validate;

            $validation->check($_POST, [
                'username' => [
                    'display' => 'Pseudo',
                    'required' => true
                ],
                'password' => [
                    'display' => 'Mot de passe',
                    'required' => true   
                ]
            ]);
            if($validation->passed()) {

                $username = Input::get('username');
                $check = Input::get('remember');
                $user = $this->user->findByUsername($username);

                if($user && password_verify(Input::get('password'), $user->password)) {
                    $user->login($check);
                    Router::redirect('home/index');
                }else {
                    $validation->addError(["Votre nom d'utilisateur ou votre mot de passe est incorrecte!"]);
                }
                
            }
            
            $this->view->displayErrors = $validation->displayErrors();

        } 
        if(empty($_SESSION)) {
            $this->view->render($this->request);
        }else {
            Router::redirect('home/index');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        Router::redirect('home/index');
    }

}