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
    
}
