<?php


class Vendedor {
    public $cedula;
    public $nombres;
    public $apellidos;
    public $telefono;
    
    function getCedula() {
        return $this->cedula;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function mapear($resul){
        $this->cedula = $resul['cedula'];
        $this->nombres = $resul['nombres'];
        $this->apellidos = $resul['apellidos'];
        $this->telefono = $resul['telefono'];
    }
    
    
}
