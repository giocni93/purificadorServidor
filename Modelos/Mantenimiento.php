<?php

class Mantenimiento {
    
    private $id;
    private $asesor;
    private $fecha;
    private $fechaProgramada;
    private $fechaRealizacion;
    private $nombreTecnico;
    private $observacion;
    private $motivo;
    private $ciudad;
    private $valorPagado;
    
    function getValorPagado() {
        return $this->valorPagado;
    }

    function setValorPagado($valorPagado) {
        $this->valorPagado = $valorPagado;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }
    
    function getId() {
        return $this->id;
    }

    function getAsesor() {
        return $this->asesor;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getFechaProgramada() {
        return $this->fechaProgramada;
    }

    function getFechaRealizacion() {
        return $this->fechaRealizacion;
    }

    function getNombreTecnico() {
        return $this->nombreTecnico;
    }

    function getObservacion() {
        return $this->observacion;
    }

    function getMotivo() {
        return $this->motivo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAsesor($asesor) {
        $this->asesor = $asesor;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setFechaProgramada($fechaProgramada) {
        $this->fechaProgramada = $fechaProgramada;
    }

    function setFechaRealizacion($fechaRealizacion) {
        $this->fechaRealizacion = $fechaRealizacion;
    }

    function setNombreTecnico($nombreTecnico) {
        $this->nombreTecnico = $nombreTecnico;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    function setMotivo($motivo) {
        $this->motivo = $motivo;
    }


    function mapear($row){
        $this->id                       = $row['id'];
        $this->asesor                   = $row['asesor'];
        $this->fecha                    = $row['fecha'];
        $this->fechaProgramada          = $row['fecha_programada'];
        $this->fechaRealizacion         = $row['fecha_realizacion'];
        $this->nombreTecnico            = $row['nombre_tecnico'];
        $this->observacion              = $row['observacion'];
        $this->motivo                   = $row['motivo'];
        $this->ciudad                   = $row['ciudad'];
    }
    
}
