<?php


class CodeudorDao {
    
    public function RegistrarCodeudor($co){
        
        $conn = new conexion();
        $resultado = -1;
        
        if($conn->conectar()){
            
            $sql_str = "Insert into codeudor(cedula,nombre,direccion_oficina,telefono,referencia,telefono_referencia,"
                    . "id_cliente) values("
                    . "'".$co->getCedula()."',"
                    . "'".$co->getNombre()."',"
                    . "'".$co->getDireccion_oficina()."',"
                    . "'".$co->getTelefono()."',"
                    . "'".$co->getReferencia()."',"
                    . "'".$co->getTelefono_referencia()."',"
                    . "'".$co->getId_cliente()."');";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
            
        }else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
    public function ModificarCodeudor($cod,$id){
        
       $conn = new Conexion();
       $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "UPDATE codeudor SET "
                        . "nombre = '".$cod->getNombre()."',"
                        . "direccion_oficina = '".$cod->getDireccion_oficina()."',"
                        . "telefono = '".$cod->getTelefono()."',"
                        . "referencia = '".$cod->getReferencia()."',"
                        . "telefono_referencia = '".$cod->getTelefono_referencia()."'"
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
                $sql_str = "DELETE FROM codeudor WHERE id = ".$id;
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
    
    public function listaCodeudor($id){
            $conn = new Conexion();
            $listaCod = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM codeudor where id_cliente = $id";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $cod = new Codeudor();
                    $cod->mapear($row);
                    
                    $listaCod[] = array(
                        "id" => $cod->getId(),
                        "cedula" => $cod->getCedula(),
                        "nombre" => $cod->getNombre(),
                        "direccion_oficina" => $cod->getDireccion_oficina(),
                        "telefono" =>$cod->getTelefono(),
                        "referencia" =>$cod->getReferencia(),
                        "telefono_referencia" =>$cod->getTelefono_referencia()
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaCod;
    }
    
}
