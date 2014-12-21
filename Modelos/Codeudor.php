<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Codeudor
 *
 * @author fabio
 */
class Codeudor {
    
    public $id;
    public $cedula;
    public $nombre;
    public $direccion_oficina;
    public $telefono;
    public $referencia;
    public $telefono_referencia;
    public $id_cliente;
    
    function getId() {
        return $this->id;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDireccion_oficina() {
        return $this->direccion_oficina;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getTelefono_referencia() {
        return $this->telefono_referencia;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDireccion_oficina($direccion_oficina) {
        $this->direccion_oficina = $direccion_oficina;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setTelefono_referencia($telefono_referencia) {
        $this->telefono_referencia = $telefono_referencia;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }


    
}
