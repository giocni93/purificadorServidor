<?php

class Purificador {
   
    private $id;
    private $nombre;
    private $cantidad;
    private $valor;
    
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
    
    public function mapear($resul){
        $this->id          = $resul['id'];
        $this->nombre      = $resul['nombre'];
        $this->cantidad    = $resul['cantidad'];
        $this->valor       = $resul['valor'];
    }
    
}
