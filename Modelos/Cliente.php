<?php


class Cliente {
    
    private $cedula;
    private $nombre;
    private $apellido;
    private $direccion_oficina;
    private $telefono;
    private $email;
    
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
        $this->cedula          = $resul['cedula'];
        $this->cliente      = $resul['cliente'];
        $this->direccion_casa    = $resul['direccion_casa'];
        $this->telefono_casa       = $resul['telefono_casa'];
        $this->direccion_oficina = $resul['direccion_oficina'];
        $this->telefono_oficina = $resul['telefono_oficina'];
        $this->correo = $resul['correo'];
    }
    
}
