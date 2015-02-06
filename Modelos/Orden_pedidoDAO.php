<?php

class Orden_pedidoDAO {
    
    public $msg_exception;
    
    public function update_date($id,$op){
        $conn = new Conexion();
        $res = -1;
        try {
            if($conn->conectar()){
                $sql_str = "UPDATE orden_pedido SET "
                        . "fecha_instalacion = '".$op->getFechaInstalacion()."' "
                        . "WHERE id = ".$id.";";
                $sql = $conn->getConn()->prepare($sql_str);
                $res = $sql->execute();
                                    
            }else{
                $res = -2;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        $conn->desconectar();
        return $res;
    }

    public function lista_mod_fecha(){
        $conn = new Conexion();
        $lista_mod_fecha= null;
        try {
            if($conn->conectar()){
                $sql_str = "Select op.fecha_instalacion,op.id,concat(c.nombre,' ',c.apellido) as cliente,inv.nombre as "
                        . "nombre_inv from orden_pedido op inner join cliente c "
                        . "on (c.cedula = op.id_cliente) inner join inventario inv on (inv.id = op.id_inventario) "
                        . "order by op.fecha_instalacion Desc";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row){
                    $orden = new Orden_pedido();
                    $lista_mod_fecha[] = array(
                        "id" => $row["id"],
                        "fecha_instalacion" => $row["fecha_instalacion"],
                        "cliente" => $row["cliente"],
                        "nombre_inv" => $row["nombre_inv"]
                    );
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            $conn->desconectar();
            return $lista_mod_fecha;
    }
    
    public function Imprimir_orden_instalacion($id_cliente){
        $conn = new Conexion();
        $listaimpresion= null;
        try{
            if($conn->conectar()){
                $sql_str = "select  orden_pedido.*,cliente.cedula as ced, cliente.nombre as nomcli, cliente.apellido, cliente.direccion_oficina,"
                        . "cliente.telefono, inventario.nombre from orden_pedido inner join cliente "
                        . "on orden_pedido.id_cliente = cliente.cedula inner join inventario "
                        . "on orden_pedido.id_inventario = inventario.id where id_cliente='".$id_cliente."'";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
                    $o = new Orden_pedido();
                    $o->mapear($row);
                    
		    $listaimpresion[] = array(
                        "fecha_instalacion" =>$o->getFechaInstalacion(),
                        "nombre_cliente"    =>$row['nomcli'],
                        "apellido_cliente"  =>$row['apellido'],
                        "direccion_cliente" =>$row['direccion_oficina'],
                        "telefono_cliente"  =>$row['telefono'],
                        "inventario_nombre" =>$row['nombre'],
                        "cedula"            =>$row['ced']
                    );
                    
		}
            }
            else{
                $listaimpresion = -1;
            }
        }catch(Exception $ex){
           $listaimpresion = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaimpresion;
    }
    
    public function listaOrden_porCliente($cedula){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT DISTINCT op.* FROM orden_pedido op
                            INNER JOIN plan_pagos pp ON (pp.id_orden_pedido = op.id)
                            INNER JOIN detalle_plan_pagos dp ON (dp.id_plan_pagos = pp.id)
                            WHERE dp.estado = 0 AND id_cliente = '".$cedula."' ORDER BY fecha DESC";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $o = new Orden_pedido();
                    $o->mapear($row);
                    
                    $listaOrden[] = array(
                        "Id"                => $o->getId(),
                        "Fecha"             => $o->getFecha(),
                        "Descripcion"       => $o->getDescripcion(),
                        "FechaInstalacion"  => $o->getFechaInstalacion(),
                        "idCliente"         => $o->getIdCliente(),
                        "idInventario"      => $o->getIdInventario()
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
    
    public function orden_cli($id){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM orden_pedido WHERE id=".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $o = new Orden_pedido();
                    $o->mapear($row);
                    
                    $listaOrden = $o->getIdCliente();
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
    
    public function listaOrden_porClienteMan($cedula){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT op.*,m.fecha_realizacion, MAX(m.fecha_programada) as fechaVen 
                            FROM orden_pedido op LEFT JOIN mantenimiento m ON (m.id_orden_pedido = op.id) 
                            WHERE op.id_cliente = ".$cedula." 
                            GROUP BY id
                            ORDER BY op.fecha DESC";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                $f = new DateTime();
                $fecha_f = $f->format('Y-m-d');
                foreach ($resultado as $row) {
		    $o = new Orden_pedido();
                    $o->mapear($row);
                    
                    $estado = "<p style='color:green; margin: 0;'>Al dia</p>";
                    if($row['fechaVen'] != null){
                        
                        if(($row['fechaVen'] <= $fecha_f) && (($row['fecha_realizacion'] == "0000-00-00 00:00:00") || ($row['fecha_realizacion'] == null) )){
                            $estado = "<p style='color:red; margin: 0;'>Vencido</p>";
                        }
                        /*
                        if($this->meses_transcurridos($fecha_f,$row['fechaVen'] ) >= 6){
                            $estado = "<p style='color:red; margin: 0;'>Vencido</p>";
                        }*/
                    }
                    
                    $listaOrden[] = array(
                        "Id"                => $o->getId(),
                        "Fecha"             => $o->getFecha(),
                        "Descripcion"       => $o->getDescripcion(),
                        "FechaInstalacion"  => $o->getFechaInstalacion(),
                        "idCliente"         => $o->getIdCliente(),
                        "idInventario"      => $o->getIdInventario(),
                        "Estado"            => $estado
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
    
    public function capturaID(){
        $conn = new Conexion();
        //$listaOrden = null;
        try {
            if($conn->conectar()){
                $sql_str = "SELECT Max(id) as id from orden_pedido";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                $orden = null;
                foreach ($resultado as $row){
                    $orden = new Orden_pedido();
                    $orden->setId($row['id']);
                }
                
            }else{
                
            }
            return $orden;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        }


    public function RegistrarOrdePedido($re){
        
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into orden_pedido (fecha,descripcion,id_cliente,id_inventario,fecha_instalacion)"
                    ."values("
                    . "'".$re->getFecha()."',"
                    . "'".$re->getDescripcion()."',"
                    . "" .$re->getIdCliente().","
                    . "" .$re->getIdInventario().","
                    . "'".$re->getFechaInstalacion()."');";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $resultado = -2;
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
        
    }
    
    function meses_transcurridos($fecha_i,$fecha_f)
    {
            $datetime1 = new DateTime($fecha_i);
            $datetime2 = new DateTime($fecha_f);
            
            $datetime1 = new DateTime($datetime1->format("Y-m-d"));
            $datetime2 = new DateTime($datetime2->format("Y-m-d"));
            
            $interval = $datetime1->diff($datetime2);
            return $interval->format('%d');
    }
    
}
