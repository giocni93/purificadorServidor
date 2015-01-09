<?php

class Detalle_PlanPago {
   
    private $id;
    private $fechaVencimiento;
    private $valorCuota;
    private $fechaPagado;
    private $estado;
    private $idPlanPago;
    
    function getId() {
        return $this->id;
    }

    function getFechaVencimiento() {
        return $this->fechaVencimiento;
    }

    function getValorCuota() {
        return $this->valorCuota;
    }

    function getFechaPagado() {
        return $this->fechaPagado;
    }

    function getEstado() {
        return $this->estado;
    }

    function getIdPlanPago() {
        return $this->idPlanPago;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFechaVencimiento($fechaVencimiento) {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    function setValorCuota($valorCuota) {
        $this->valorCuota = $valorCuota;
    }

    function setFechaPagado($fechaPagado) {
        $this->fechaPagado = $fechaPagado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setIdPlanPago($idPlanPago) {
        $this->idPlanPago = $idPlanPago;
    }
    
    function mapear($row){
        $this->id               = $row['id'];
        $this->fechaVencimiento = $row['fecha_vencimiento'];
        $this->fechaPagado      = $row['fecha_pagado'];
        $this->valorCuota       = $row['valor_cuota'];
        $this->estado           = $row['estado'];
        $this->idPlanPago       = $row['id_plan_pagos'];
    }
    
}
