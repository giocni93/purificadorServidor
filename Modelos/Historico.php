<?php

class Historico {
    
    private $id;
    private $fecha;
    private $titulo;
    private $observacion;
    private $idCliente;
    
    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getObservacion() {
        return $this->observacion;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }
    
    function mapear($row){
        $this->id           = $row['id'];
        $this->fecha        = $row['fecha'];
        $this->titulo       = $row['titulo'];
        $this->observacion  = $row['observacion'];
        $this->idCliente    = $row['id_cliente'];
    }
    
}
