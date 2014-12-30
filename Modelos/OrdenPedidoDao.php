<?php


class OrdenPedidoDao {
    
    public function RegistrarOrdePedido($re){
        
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into orden_pedido (fecha,descripcion,id_cliente,id_inventario,fecha_instalacion)"
                    ."values("
                    . "'".$re->getFecha()."',"
                    . "'".$re->getDescripcion()."',"
                    . "" .$re->getId_cliente().","
                    . "" .$re->getId_inventario().","
                    . "'".$re->getFecha_instalacion()."');";
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
