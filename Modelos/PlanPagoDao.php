<?php


class PlanPagoDao {
    
    public function RegistrarPlanPago($re){
        
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into plan_pagos (tipo,monto,numero_cuota,fecha_credito,id_orden_pedido)"
                    ."values("
                    . "'".$re->getTipo()."',"
                    . "'".$re->getMonto()."',"
                    . "" .$re->getNumero_cuota().","
                    . "" .$re->getFecha_credito().","
                    . "'".$re->getId_orden_pedido()."');";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
        
    }
    
}
