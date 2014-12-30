<?php

class Plan_pagosDAO {
    
    public $msg_exception;
    
    public function listaplan_porOrden($id){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT p.*,d.fecha_vencimiento,d.valor_cuota,d.fecha_pagado,d.estado,d.id as idDetalle  
                            FROM plan_pagos as p INNER JOIN detalle_plan_pagos as d 
                            ON (p.id = d.id_plan_pagos)
                            WHERE p.id_orden_pedido = ".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $o = new Plan_pagos();
                    $o->mapear($row);
                    
                    $listaOrden[] = array(
                        "Id"                => $o->getId(),
                        "Tipo"              => $o->getTipo(),
                        "Monto"             => $o->getMonto(),
                        "NumeroCuota"       => $o->getNumeroCuota(),
                        "FechaCredito"      => $o->getFechaCredito(),
                        "FechaVencimiento"  => $row['fecha_vencimiento'],
                        "ValorCuota"        => $row['valor_cuota'],
                        "FechaPagado"       => $row['fecha_pagado'],
                        "Estado"            => $row['estado'],
                        "IdDetalle"         => $row['idDetalle']
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
