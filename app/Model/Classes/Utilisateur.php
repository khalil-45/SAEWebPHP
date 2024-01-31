<?php

namespace Model\Classes;

class Utilisateur {
    private $user_id;
    private $username;
    private $password;
    private $email;

    public function __construct($user_id, $username, $password, $email) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }
}
