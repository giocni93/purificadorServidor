<?php


class ReferenciaDao {
    
    public function RegistrarReferencia($re){
        
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into referencia_cliente (nombre,telefono,id_cliente) "
                    ."values("
                    . "'" .$re->getNombre() ."',"
                    . "'" .$re->getTelefono() ."',"
                    . "'" .$re->getId_cliente() ."');";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
        
    }
    
    public function ModificarReferencia($nombre,$telefono,$direccion,$cedula){
        
       try {
            $conn = new conexion();
            $conn->conectar();
            $sql = $conn->getConn()->prepare("Update cliente set "
                    +"nombre = '"+$nombre+"',"
                    +"telefono = '"+$telefono+"',"
                    +"direccion = '"+$direccion+"',"
                    +"where cedula = '"+$cedula+"'");
            $sql->execute();
            
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        
    }
    
    public function listaReferencia($val){
            $conn = new conexion();
            $conn->conectar();
            $arrayreferencia = null;
        try {
            
            $sql = $conn->getConn()->prepare("Select * from referencia Where "
                    +"cedula like '%"+$val+"%' OR"
                    +"nombre like '%"+$val+"%'");
            
            $sql->execute();
            $resultado = $sql->fetchAll();
           foreach ($resultado as $row){
                
                $ref = new Referencia();
                $ref->mapear($row);
                $arrayreferencia[] = array(
                    "id" =>$ref->getId(),
                    "nombre" => $ref->getNombre(),
                    "telefono" => $ref->getTelefono(),
                    "direccion" => $ref->getDireccion(),
                    "cedula" => $ref->getCedula(),
                    "cedula_cliente" => $ref->getCedula_cliente(),
                );
            }
            
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return $arrayreferencia;
    }
    
}
