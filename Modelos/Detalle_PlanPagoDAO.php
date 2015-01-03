<?php

class Detalle_PlanPagoDAO {
    
    public $msg_exception;
    
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
