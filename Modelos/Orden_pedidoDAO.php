<?php

class Orden_pedidoDAO {
    
    public $msg_exception;
    
    public function listaOrden_porCliente($cedula){
        $conn = new Conexion();
        $listaOrden = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM orden_pedido WHERE id_cliente = '".$cedula."' ORDER BY fecha DESC";
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
    
}
