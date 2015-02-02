<?php


class Cliente {
    
    private $cedula;
    private $nombre;
    private $apellido;
    private $direccion_oficina;
    private $direccion_casa;
    private $telefono;
    private $email;
    private $labor;
    
    function getLabor() {
        return $this->labor;
    }

    function setLabor($labor) {
        $this->labor = $labor;
    }

    function getDireccion_casa() {
        return $this->direccion_casa;
    }

    function setDireccion_casa($direccion_casa) {
        $this->direccion_casa = $direccion_casa;
    }
    
    function getCedula() {
        return $this->cedula;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getDireccion_oficina() {
        return $this->direccion_oficina;
    }
    
    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setDireccion_oficina($direccion_oficina) {
        $this->direccion_oficina = $direccion_oficina;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }
   
    public function mapear($resul){
        $this->cedula = $resul['cedula'];
        $this->nombre = $resul['nombre'];
        $this->apellido = $resul['apellido'];
        $this->direccion_oficina = $resul['direccion_oficina'];
        $this->telefono = $resul['telefono'];
        $this->email = $resul['email'];
        $this->direccion_casa = $resul['direccion_casa'];
        $this->labor = $resul['labor'];
    }
    
}
