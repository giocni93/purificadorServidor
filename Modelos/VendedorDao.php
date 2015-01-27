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
                        "apellidos"  => $ven->getApellidos()
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
