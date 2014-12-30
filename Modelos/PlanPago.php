<?php


class PlanPago {
    
    public $id;
    public $tipo;
    public $monto;
    public $numero_cuota;
    public $fecha_credito;
    public $id_orden_pedido;
    
    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getMonto() {
        return $this->monto;
    }

    function getNumero_cuota() {
        return $this->numero_cuota;
    }

    function getFecha_credito() {
        return $this->fecha_credito;
    }

    function getId_orden_pedido() {
        return $this->id_orden_pedido;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setNumero_cuota($numero_cuota) {
        $this->numero_cuota = $numero_cuota;
    }

    function setFecha_credito($fecha_credito) {
        $this->fecha_credito = $fecha_credito;
    }

    function setId_orden_pedido($id_orden_pedido) {
        $this->id_orden_pedido = $id_orden_pedido;
    }

    
    public function mapear($resul){
        $this->id = $resul['id'];
        $this->tipo = $resul['tipo'];
        $this->monto = $resul['monto'];
        $this->numero_cuota = $resul['numero_cuota'];
        $this->fecha_credito = $resul['fecha_credito'];
        $this->id_orden_pedido = $resul['id_orden_pedido'];
    }
    
}
