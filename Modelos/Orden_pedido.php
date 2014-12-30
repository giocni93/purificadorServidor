<?php

class Orden_pedido {
    
    private $id;
    private $fecha;
    private $descripcion;
    private $idCliente;
    private $idInventario;
    private $fechaInstalacion;
    
    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getIdInventario() {
        return $this->idInventario;
    }

    function getFechaInstalacion() {
        return $this->fechaInstalacion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setIdInventario($idInventario) {
        $this->idInventario = $idInventario;
    }

    function setFechaInstalacion($fechaInstalacion) {
        $this->fechaInstalacion = $fechaInstalacion;
    }

    function mapear($row){
        $this->id               = $row['id'];
        $this->fecha            = $row['fecha'];
        $this->descripcion      = $row['descripcion'];
        $this->idCliente        = $row['id_cliente'];
        $this->idInventario     = $row['id_inventario'];
        $this->fechaInstalacion = $row['fecha_instalacion'];
    }

}
