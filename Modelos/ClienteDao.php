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
    
    public function ModificarCliente($cedula,$cliente,$direccion_casa,$telefono_casa,
            $direccion_oficina,$telefono_oficina,$correo){
        
       try {
            $conn = new conexion();
            $conn->conectar();
            $sql = $conn->getConn()->prepare("Update cliente set "
                    +"cliente = '"+$cliente+"',"
                    +"direccion_casa = '"+$direccion_casa+"',"
                    +"telefono_casa = '"+$telefono_casa+"',"
                    +"direccion_oficina = '"+$direccion_oficina+"',"
                    +"telefono_oficina = '"+$telefono_oficina+"',"
                    +"correo = '"+$correo+"' where cedula = '"+$cedula+"'");
            $sql->execute();
            
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        
    }
    
    public function EliminarCliente($cedula){
        
        
        try {
            $conn = new conexion();
            $conn->conectar();
            $sql = $conn->getConn()->prepare("Delete * from cliente where cedula='$cedula'");
            
            $sql->execute();
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        
    }
    
    public function listaClientes($val){
            $conn = new conexion();
            $conn->conectar();
            $arrayclientes = null;
        try {
            
            $sql = $conn->getConn()->prepare("Select * from clientes Where "
                    +"cedula like '%"+$val+"%' OR"
                    +"cliente like '%"+$val+"%' OR"
                    +"correo like'%"+$val+"%'");
            
            $sql->execute();
            $resultado = $sql->fetchAll();
           foreach ($resultado as $row){
                
                $cli = new Cliente();
                $cli->mapear($row);
                $arrayclientes[] = array(
                    "cedula" => $cli->getCedula(),
                    "cliente" => $cli->getCliente(),
                    "direccion_casa" => $cli->getDireccion_casa(),
                    "telefono_casa" => $cli->getTelefono_casa(),
                    "direccion_oficina" => $cli->getDireccion_oficina(),
                    "telefono_oficina" =>$cli->getTelefono_oficina(),
                    "correo" => $cli->getCorreo(),
                );
            }
            
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return $arrayclientes;
    }
    
    
    
}
