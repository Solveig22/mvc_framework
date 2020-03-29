<?php

namespace Enway\App\Models;

use Enway\App\Core\Cookie;
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
        if($remember) {
            $hash = uniqid();
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = [
                'session' => $hash,
                'user_agent' => $user_agent,
                'user_id' => $this->id
            ];

            $this->db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);

            $this->db->insert('user_sessions', $fields);
        }
    }

}