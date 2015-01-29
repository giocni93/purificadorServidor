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
    
    public function ModificarReferencia($ref,$id){
        
       $conn = new Conexion();
       $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "UPDATE referencia_cliente SET "
                        . "nombre = '".$ref->getNombre()."',"
                        . "telefono = '".$ref->getTelefono()."'"
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
    
    public function borrar($id){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "DELETE FROM referencia_cliente WHERE id = ".$id;
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
    
    public function listaReferencia($id){
            $conn = new Conexion();
            $listaRef = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM referencia_cliente where id_cliente = $id";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $ref = new Referencia();
                    $ref->mapear($row);
                    
                    $listaRef[] = array(
                        "nombre" => $ref->getNombre(),
                        "telefono" => $ref->getTelefono(),
                        "id" =>$ref->getId()
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaRef;
    }
    
    public function listaRef(){
            $conn = new Conexion();
            $listaRef = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT r.*,CONCAT(c.nombre,' ',c.apellido) as nomCliente ,
                            c.telefono as telefonoCli,c.direccion_oficina as DireccionCli
                            FROM referencia_cliente r 
                            INNER JOIN cliente c ON (c.cedula = r.id_cliente)";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $ref = new Referencia();
                    $ref->mapear($row);
                    
                    $listaRef[] = array(
                        "nombre" => $ref->getNombre(),
                        "telefono" => $ref->getTelefono(),
                        "NombreCliente" =>$row['nomCliente'],
                        "TelefonoCliente" =>$row['telefonoCli'],
                        "DireccionCli" =>$row['DireccionCli']
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $listaRef = $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaRef;
    }
    
}
