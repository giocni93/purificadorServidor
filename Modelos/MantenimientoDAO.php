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
                    
                    $listaOrden[] = array(
                        "Id"                => $o->getId(),
                        "Asesor"            => $o->getAsesor(),
                        "Fecha"             => $o->getFecha(),
                        "FechaProgramada"   => $o->getFechaProgramaga(),
                        "FechaRealizacion"  => $o->getFechaRealizacion(),
                        "NombreTecnico"     => $o->getNombreTecnico(),
                        "Observacion"       => $o->getObservacion(),
                        "Motivo"            => $o->getMotivo(),
                        "Ciudad"            => $o->getCiudad(),
                        "NombreCliente"     => $row['nombre'],
                        "ApellidoCliente"   => $row['apellido'],
                        "DireccionCliente"  => $row['direccion_oficina'],
                        "TelefonoCliente"    => $row['telefono'],
                        "NombreInv"         => $row['nomInv'],
                        "NombreTipo"        => $row['nomTipo']
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
