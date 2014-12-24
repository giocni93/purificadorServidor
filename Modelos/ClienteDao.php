<?php

class ClienteDao {

    public function RegistrarCliente($pu){
        
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into cliente (cedula,nombre,apellido,direccion_oficina,telefono,email) "
                    ."values("
                    . "'" .$pu->getCedula() ."',"
                    . "'" .$pu->getNombre() ."',"
                    . "'" .$pu->getApellido() ."',"
                    . "'" .$pu->getDireccion_oficina() ."',"
                    . "'" .$pu->getTelefono() ."',"
                    . "'" .$pu->getEmail() ."');";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
        
    }
    
    public function ModificarCliente($cli,$ced){
        
       $conn = new Conexion();
       $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "UPDATE cliente SET "
                        . "nombre = '".$cli->getNombre()."',"
                        . "apellido = '".$cli->getApellido()."',"
                        . "direccion_oficina = '".$cli->getDireccion_oficina()."',"
                        . "telefono = '".$cli->getTelefono()."',"
                        . "email = '".$cli->getEmail()."'"
                        . "WHERE cedula = ".$ced;
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
                $sql_str = "DELETE FROM cliente WHERE cedula = ".$id;
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
    
    public function listaClientes(){
            $conn = new Conexion();
            $listaCli = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM cliente;";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $cli = new Cliente();
                    $cli->mapear($row);
                    
                    $listaCli[] = array(
                        "cedula" => $cli->getCedula(),
                        "nombre" => $cli->getNombre(),
                        "apellido" => $cli->getApellido(),
                        "direccion_oficina" =>$cli->getDireccion_oficina(),
                        "telefono" =>$cli->getTelefono(),
                        "email" =>$cli->getEmail()
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaCli;
    }
    
    
    
}
