<?php

class Inventario {
    private $id;
    private $nombre;
    private $cantidad;
    private $valor;
    private $imagen;
    private $id_tipo_inventario;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getValor() {
        return $this->valor;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getId_tipo_inventario() {
        return $this->id_tipo_inventario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setId_tipo_inventario($id_tipo_inventario) {
        $this->id_tipo_inventario = $id_tipo_inventario;
    }
    
    function mapear($row){
        $this->id                   = $row['id'];
        $this->cantidad             = $row['cantidad'];
        $this->nombre               = $row['nombre'];
        $this->valor                = $row['valor'];
        $this->imagen               = $row['imagen'];
        $this->id_tipo_inventario   = $row['id_tipo_inventario'];
        
    }
    
}
