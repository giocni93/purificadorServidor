<?php

class Detalle_PlanPagoDAO {
    
    public $msg_exception;
    
    public function RegistrarDetallePlanPago($re){
        
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into detalle_plan_pagos (fecha_vencimiento,valor_cuota,estado,id_plan_pagos) "
                    ."values("
                    . "'".$re->getFechaVencimiento()."',"
                    . "".$re->getValorCuota().","
                    . "" .$re->getEstado().","
                    . "" .$re->getIdPlanPago().");";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
        
    }
    
    public function modificar($det,$id){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "UPDATE detalle_plan_pagos SET "
                        . "fecha_pagado = '".$det->getFechaPagado()."',"
                        . "estado = ".$det->getEstado()." "
                        . "WHERE id = ".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                
                $res = $sql->execute();
            }
            else{
                $res = -2;
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $res;
    }
    
}
