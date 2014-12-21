<?php

class CategoriaDAO {
    
    public $msg_exception;
    
    public function listaCategorias(){
        $conn = new Conexion();
        $listaCat = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM categoria;";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $cat = new Categoria();
                    $cat->mapear($row);
                    
                    $listaCat[] = array(
                        "Id"        => $cat->getId(),
                        "Nombre"    => $cat->getNombre()
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaCat;
    }
    
    public function registrar($cat){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "INSERT INTO categoria (nombre) "
                        . "VALUES ('".$cat->getNombre()."');";
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
    
}
