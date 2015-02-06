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
    
    public function listaMantenimiento2($id){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT c.nombre,c.apellido,c.direccion_casa,c.telefono,m.*
                    FROM cliente c
                    INNER JOIN mantenimiento m ON (m.id_cliente = c.cedula)
                    WHERE m.id_cliente = '".$id."'";
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
                        "DireccionCliente"  => $row['direccion_casa'],
                        "TelefonoCliente"    => $row['telefono'],
                        "NombreInv"         => '--',
                        "NombreTipo"        => '--',
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
    
    public function listaMantenimiento_id2($id){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT c.nombre,c.apellido,c.direccion_casa,c.telefono,m.* 
                    FROM cliente c 
                    INNER JOIN mantenimiento m ON (m.id_cliente = c.cedula)
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
                        "DireccionCliente"  => $row['direccion_casa'],
                        "TelefonoCliente"    => $row['telefono'],
                        "NombreInv"         => '--',
                        "NombreTipo"        => '--',
                        "idOp"              => '--'
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
    
    public function tareas_hoy(){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT
                            op.id as codigo,CONCAT(c.nombre,' ',c.apellido) as cliente,dp.fecha_vencimiento as fecha,'Pago' as tipo
                            FROM
                            cliente c
                            INNER JOIN orden_pedido op 	     ON (op.id_cliente = c.cedula)
                            INNER JOIN plan_pagos pp   	     ON (pp.id_orden_pedido = op.id)
                            INNER JOIN detalle_plan_pagos dp ON (dp.id_plan_pagos = pp.id)
                            WHERE
                            dp.fecha_vencimiento <= NOW() AND dp.estado = 0
                            UNION
                            SELECT
                            ma.id as codigo,CONCAT(c.nombre,' ',c.apellido) as cliente,ma.fecha_programada as fecha,'Mantenimiento' as tipo
                            FROM
                            cliente c
                            INNER JOIN orden_pedido op 	ON (op.id_cliente = c.cedula)
                            INNER JOIN mantenimiento ma ON (ma.id_orden_pedido = op.id)
                            WHERE
                            ma.fecha_programada <= NOW() AND ma.fecha_realizacion IS NULL 
                            UNION
                            SELECT
                            ma.id as codigo,CONCAT(c.nombre,' ',c.apellido) as cliente,ma.fecha_programada as fecha,'Mantenimiento' as tipo
                            FROM
                            cliente c
                            INNER JOIN mantenimiento ma ON (ma.id_cliente = c.cedula)
                            WHERE
                            ma.fecha_programada <= NOW() AND ma.fecha_realizacion IS NULL 
                            ORDER BY fecha DESC";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
                    $listaOrden[] = array(
                        "Codigo"        => $row['codigo'],
                        "Fecha"         => $row['fecha'],
                        "Cliente"       => $row['cliente'],
                        "Tipo"          => $row['tipo']
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
            return $this->msg_exception;
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
    
    public function registrar($inv,$idOrden,$ic){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "INSERT INTO mantenimiento (asesor,fecha,fecha_programada,nombre_tecnico,motivo,ciudad,id_orden_pedido,id_cliente) "
                        . "VALUES ('".$inv->getAsesor()."',"
                        . "'".$inv->getFecha()."',"
                        . "'".$inv->getFechaProgramada()."',"
                        . "'".$inv->getNombreTecnico()."',"
                        . "'".$inv->getMotivo()."',"
                        . "'".$inv->getCiudad()."',"
                        . "".$idOrden.","
                        . "".$ic.");";
                $sql = $conn->getConn()->prepare($sql_str);
                
                $res = $sql->execute();
            }
            else{
                $res = -2;
            }
        }catch(Exception $ex){
            $res = $this->msg_exception = $ex->getMessage();
            $res = $sql_str;
        }
        $conn->desconectar();
        return $res;
    }
    
    public function registrar2($inv,$idC){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "INSERT INTO mantenimiento (asesor,fecha,fecha_programada,nombre_tecnico,motivo,ciudad,id_cliente,tipo) "
                        . "VALUES ('".$inv->getAsesor()."',"
                        . "'".$inv->getFecha()."',"
                        . "'".$inv->getFechaProgramada()."',"
                        . "'".$inv->getNombreTecnico()."',"
                        . "'".$inv->getMotivo()."',"
                        . "'".$inv->getCiudad()."',"
                        . "'".$idC."',"
                        . "'Man. tecnico');";
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
                        . "fecha_programada = '".$inv->getFechaProgramada()."',"
                        . "nombre_tecnico = '".$inv->getNombreTecnico()."',"
                        . "motivo = '".$inv->getMotivo()."',"
                        . "observacion = '".$inv->getObservacion()."',"
                        . "valor_pagado = ".$inv->getValorPagado()." ,"
                        . "ciudad = '".$inv->getCiudad()."',";
                if($inv->getFechaRealizacion() != null){
                    $sql_str .= "fecha_realizacion = '".$inv->getFechaRealizacion()."' "
                            . "WHERE id = ".$id;
                }else{
                    $sql_str .= "fecha_realizacion = NULL "
                            . "WHERE id = ".$id;
                }
                
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
