<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Referencia
 *
 * @author fabio
 */
class Referencia {
    
    public $id;
    public $nombre;
    public $telefono;
    public $id_cliente;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    
    public function mapear($resul){
        $this->id          = $resul['id'];
        $this->nombre      = $resul['nombre'];
        $this->telefono    = $resul['telefono'];
        $this->cedula_cliente = $resul['id_cliente'];
    }
    
}
