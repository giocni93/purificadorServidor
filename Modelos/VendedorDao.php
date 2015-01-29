<?php


class VendedorDao {
    
    public function insertarvendedor($resul){
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into vendedores (cedula,nombres,apellidos,telefono) "
                    ."values("
                    . "'" .$resul->getCedula(). "',"
                    . "'".$resul->getNombres(). "',"
                    . "'".$resul->getApellidos()."',"
                    . "'".$resul->getTelefono()."');";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
    public function ModificarVendedor($ref,$id){
        
       $conn = new Conexion();
       $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "UPDATE vendedores SET "
                        . "nombres = '".$ref->getNombres()."',"
                        . "apellidos = '".$ref->getApellidos()."',"
                        . "telefono = '".$ref->getTelefono()."' "
                        . "WHERE cedula = ".$id;
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
                $sql_str = "DELETE FROM vendedores WHERE cedula = ".$id;
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
    
    public function listaVendedores(){
        $conn = new Conexion();
        $listaVed = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM vendedores;";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $ven = new Vendedor();
                    $ven->mapear($row);
                    
                    $listaVed[] = array(
                        "cedula"     => $ven->getCedula(),
                        "nombres"    => $ven->getNombres(),
                        "apellidos"  => $ven->getApellidos(),
                        "telefono"   => $ven->getTelefono()    
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaVed;
    }
    
}
