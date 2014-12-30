<?php

class Plan_pagos {
    
    private $id;
    private $tipo;
    private $monto;
    private $numeroCuota;
    private $fechaCredito;
    private $idOrdenPedido;
    
    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getMonto() {
        return $this->monto;
    }

    function getNumeroCuota() {
        return $this->numeroCuota;
    }

    function getFechaCredito() {
        return $this->fechaCredito;
    }

    function getIdOrdenPedido() {
        return $this->idOrdenPedido;
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

    function setNumeroCuota($numeroCuota) {
        $this->numeroCuota = $numeroCuota;
    }

    function setFechaCredito($fechaCredito) {
        $this->fechaCredito = $fechaCredito;
    }

    function setIdOrdenPedido($idOrdenPedido) {
        $this->idOrdenPedido = $idOrdenPedido;
    }

    function mapear($row){
        $this->id           = $row['id'];
        $this->tipo         = $row['tipo'];
        $this->monto        = $row['monto'];
        $this->numeroCuota  = $row['numero_cuota'];
        $this->fechaCredito = $row['fecha_credito'];
        $this->idOrdenPedido= $row['id_orden_pedido'];
    }
    
}
