<?php

class MantenimientoDAO {
    
    public $msg_exception;
    
    public function listaMantenimiento($id){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT c.nombre,c.apellido,c.direccion_oficina,c.telefono,m.*,inv.nombre as nomInv,ti.nombre as nomTipo
                    FROM cliente c 
                    INNER JOIN orden_pedido op ON (c.cedula = op.id_cliente) 
                    INNER JOIN mantenimiento m ON (m.id_orden_pedido = op.id)
                    INNER JOIN inventario inv ON (inv.id = op.id_inventario)
                    INNER JOIN tipo_inventario ti ON (inv.id_tipo_inventario = ti.id)
                    WHERE op.id = ".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $o = new Mantenimiento();
                    $o->mapear($row);
                    $fecha = new DateTime($o->getFechaRealizacion());
                    $f = $fecha->format('Y-m-d H:i A');
                    if($o->getFechaRealizacion() == null){
                        $f = null;
                    }
                    $listaOrden[] = array(
                        "Id"                => $o->getId(),
                        "Asesor"            => $o->getAsesor(),
                        "Fecha"             => $o->getFecha(),
                        "FechaProgramada"   => $o->getFechaProgramada(),
                        "FechaRealizacion"  => $f,
                        "NombreTecnico"     => $o->getNombreTecnico(),
                        "Observacion"       => $o->getObservacion(),
                        "Motivo"            => $o->getMotivo(),
                        "Ciudad"            => $o->getCiudad(),
                        "NombreCliente"     => $row['nombre'],
                        "ApellidoCliente"   => $row['apellido'],
                        "DireccionCliente"  => $row['direccion_oficina'],
                        "TelefonoCliente"    => $row['telefono'],
                        "NombreInv"         => $row['nomInv'],
                        "NombreTipo"        => $row['nomTipo'],
                        "ValorPagado"       => $row['valor_pagado']
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaOrden;
    }
    
    public function listaMantenimiento_id($id){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT op.id as idOp,c.nombre,c.apellido,c.direccion_oficina,c.telefono,m.*,inv.nombre as nomInv,ti.nombre as nomTipo
                    FROM cliente c 
                    INNER JOIN orden_pedido op ON (c.cedula = op.id_cliente) 
                    INNER JOIN mantenimiento m ON (m.id_orden_pedido = op.id)
                    INNER JOIN inventario inv ON (inv.id = op.id_inventario)
                    INNER JOIN tipo_inventario ti ON (inv.id_tipo_inventario = ti.id)
                    WHERE m.id = ".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $o = new Mantenimiento();
                    $o->mapear($row);
                    $fecha = new DateTime($o->getFechaRealizacion());
                    $f = $fecha->format('Y-m-d')."T".$fecha->format('H:i');
                    if($o->getFechaRealizacion() == null){
                        $f = null;
                    }
                    $listaOrden[] = array(
                        "Id"                => $o->getId(),
                        "Asesor"            => $o->getAsesor(),
                        "Fecha"             => $o->getFecha(),
                        "FechaProgramada"   => $o->getFechaProgramada(),
                        "FechaRealizacion"  => $f,
                        "NombreTecnico"     => $o->getNombreTecnico(),
                        "Observacion"       => $o->getObservacion(),
                        "Motivo"            => $o->getMotivo(),
                        "Ciudad"            => $o->getCiudad(),
                        "NombreCliente"     => $row['nombre'],
                        "ApellidoCliente"   => $row['apellido'],
                        "DireccionCliente"  => $row['direccion_oficina'],
                        "TelefonoCliente"    => $row['telefono'],
                        "NombreInv"         => $row['nomInv'],
                        "NombreTipo"        => $row['nomTipo'],
                        "idOp"              => $row['idOp']
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaOrden;
    }
    
    public function listaMan($id){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM mantenimiento WHERE id = ".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $o = new Mantenimiento();
                    $o->mapear($row);
                    $fecha = new DateTime($o->getFechaRealizacion());
                    $f = $fecha->format('Y-m-d')."T".$fecha->format('H:i');
                    if($o->getFechaRealizacion() == null){
                        $f = null;
                    }
                    $listaOrden[] = array(
                        "Id"                => $o->getId(),
                        "Asesor"            => $o->getAsesor(),
                        "Fecha"             => $o->getFecha(),
                        "FechaProgramada"   => $o->getFechaProgramada(),
                        "FechaRealizacion"  => $f,
                        "NombreTecnico"     => $o->getNombreTecnico(),
                        "Observacion"       => $o->getObservacion(),
                        "Motivo"            => $o->getMotivo(),
                        "Ciudad"            => $o->getCiudad()
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaOrden;
    }
    
    public function registrar($inv,$idOrden){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "INSERT INTO mantenimiento (asesor,fecha,fecha_programada,nombre_tecnico,motivo,ciudad,id_orden_pedido) "
                        . "VALUES ('".$inv->getAsesor()."',"
                        . "'".$inv->getFecha()."',"
                        . "'".$inv->getFechaProgramada()."',"
                        . "'".$inv->getNombreTecnico()."',"
                        . "'".$inv->getMotivo()."',"
                        . "'".$inv->getCiudad()."',"
                        . "'".$idOrden."');";
                $sql = $conn->getConn()->prepare($sql_str);
                
                $res = $sql->execute();
            }
            else{
                $res = -2;
            }
        }catch(Exception $ex){
            $res = $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $res;
    }
    
    
    public function update($inv,$id){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "UPDATE mantenimiento SET "
                        . "asesor = '".$inv->getAsesor()."',"
                        . "fecha_realizacion = '".$inv->getFechaRealizacion()."',"
                        . "fecha_programada = '".$inv->getFechaProgramada()."',"
                        . "nombre_tecnico = '".$inv->getNombreTecnico()."',"
                        . "motivo = '".$inv->getMotivo()."',"
                        . "observacion = '".$inv->getObservacion()."',"
                        . "valor_pagado = ".$inv->getValorPagado()." ,"
                        . "ciudad = '".$inv->getCiudad()."' "
                        . "WHERE id = ".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                
                $res = $sql->execute();
            }
            else{
                $res = -2;
            }
        }catch(Exception $ex){
            $res = $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $res;
    }
    
}
