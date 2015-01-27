<?php


class PlanPagoDao {
    
    public $msg_exception;

    public function RegistrarPlanPago($re){
        
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into plan_pagos (tipo,monto,numero_cuota,fecha_credito,id_orden_pedido)"
                    ."values("
                    . "'".$re->getTipo()."',"
                    . "'".$re->getMonto()."',"
                    . "" .$re->getNumero_cuota().","
                    . "'" .$re->getFecha_credito()."',"
                    . "" .$re->getId_orden_pedido().");";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
        
    }
    
    public function capturaMaxID(){
        $conn = new Conexion();
        //$listaOrden = null;
        $id = "";
        try {
            if($conn->conectar()){
                $sql_str = "SELECT Max(id) as id from plan_pagos";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                $orden = null;
                foreach ($resultado as $row){
                    $orden = new PlanPago();
                    $id = $row['id'];
                }
                
            }else{
                
            }
            return $id;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        }
    
    public function listaplan_porOrden($id){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT p.*,d.fecha_vencimiento,d.valor_cuota,d.fecha_pagado,d.estado,d.id as idDetalle,CONCAT(c.nombre,' ',c.apellido) as nomCli 
                            FROM plan_pagos as p INNER JOIN detalle_plan_pagos as d 
                            ON (p.id = d.id_plan_pagos)
                            INNER JOIN orden_pedido op ON (op.id = p.id_orden_pedido) 
                            INNER JOIN cliente c ON (c.cedula = op.id_cliente)
                            WHERE p.id_orden_pedido = ".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $o = new PlanPago();
                    $o->mapear($row);
                    
                    $listaOrden[] = array(
                        "Id"                => $o->getId(),
                        "Tipo"              => $o->getTipo(),
                        "Monto"             => $o->getMonto(),
                        "NumeroCuota"       => $o->getNumero_cuota(),
                        "FechaCredito"      => $o->getFecha_credito(),
                        "FechaVencimiento"  => $row['fecha_vencimiento'],
                        "ValorCuota"        => $row['valor_cuota'],
                        "FechaPagado"       => $row['fecha_pagado'],
                        "Estado"            => $row['estado'],
                        "IdDetalle"         => $row['idDetalle'],
                        "NombreCliente"     => $row['nomCli']
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
    
}
