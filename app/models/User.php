<?php

namespace Enway\App\Models;

use Enway\App\Core\Model;
use Enway\App\Core\Session;

class User extends Model{

    protected $sessionName;
    protected $cookieName;

    public function __construct() {
        parent::__construct();
        $this->sessionName = CURRENT_USER_SESSION_NAME;
        $this->cookieName = REMEMBER_ME_COOKIE_NAME;
    }

    public function findByUsername($username) {
        return $this->findFirst(array(
            'conditions' => 'username = ?',
            'bind' => [$username]
        ));
    }


    public function login($remember) {
        Session::set($this->sessionName, $this->id);
    }

}