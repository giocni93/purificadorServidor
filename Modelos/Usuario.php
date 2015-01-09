<?php


class Usuario {
    
    public $id;
    public $user;
    public $pass;
    
    function getId() {
        return $this->id;
    }

    function getUser() {
        return $this->user;
    }

    function getPass() {
        return $this->pass;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    public function mapear($resul){
        $this->id = $resul['id'];
        $this->user = $resul['user'];
        $this->pass = $resul['pass'];
    }
    
}
