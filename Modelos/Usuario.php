<?php


class Usuario {
    
    public $id;
    public $user;
    public $pass;
    public $nombre;
    public $apellido;
    public $rol;
    
    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getRol() {
        return $this->rol;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

        
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
