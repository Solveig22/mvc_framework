<?php

namespace Enway\App\Controller;

use Enway\App\Core\Controller;
use Enway\App\Core\Input;
use Enway\App\Core\Validate;

class Register extends Controller {

    public function __construct($request) {
        $this->loadModel('User');
        parent::__construct($request);
    }

    public function login() {
        if(isset($_POST) && !empty($_POST)) {
            dump($_POST);
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
                    dump($_SESSION);
                }else {
                    $validation->addError(["Votre nom d'utilisateur ou votre mot de passe est incorrecte!"]);
                }
                
            }
            
            $this->view->set('validation', $validation);
        }
        
        $this->view->render($this->request);
    }

}