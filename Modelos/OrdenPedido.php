<?php


class OrdenPedido {
    
    public $id;
    public $fecha;
    public $descripcion;
    public $id_cliente;
    public $id_inventario;
    public $fecha_instalacion;
    
    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function getId_inventario() {
        return $this->id_inventario;
    }

    function getFecha_instalacion() {
        return $this->fecha_instalacion;
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

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    function setId_inventario($id_inventario) {
        $this->id_inventario = $id_inventario;
    }

    function setFecha_instalacion($fecha_instalacion) {
        $this->fecha_instalacion = $fecha_instalacion;
    }

    
    public function mapear($resul){
        $this->id = $resul['id'];
        $this->fecha = $resul['fecha'];
        $this->descripcion = $resul['descripcion'];
        $this->id_cliente = $resul['id_cliente'];
        $this->id_inventario = $resul['id_inventario'];
        $this->fecha_instalacion = $resul['fecha_instalacion'];
    }
    
}
