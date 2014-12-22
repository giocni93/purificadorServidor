<?php

class Tipo_inventarioDAO {
    
    public $msg_exception;
    
    public function listaTipo_inv($idCat){
        $conn = new Conexion();
        $listaTip = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM tipo_inventario WHERE id_categoria = ".$idCat;
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $t = new Tipo_inventario();
                    $t->mapear($row);
                    
                    $listaTip[] = array(
                        "Id"        => $t->getId(),
                        "Nombre"    => $t->getNombre()
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaTip;
    }
    
    public function lista(){
        $conn = new Conexion();
        $listaTip = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT t.*,c.nombre as categoria FROM tipo_inventario as t "
                        . "INNER JOIN categoria as c ON (t.id_categoria = c.id)";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $t = new Tipo_inventario();
                    $t->mapear($row);
                    
                    $listaTip[] = array(
                        "Id"        => $t->getId(),
                        "Nombre"    => $t->getNombre(),
                        "Categoria" => $row['categoria']
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
            return "Error";
        }
        $conn->desconectar();
        return $listaTip;
    }
    
    public function registrar($t){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "INSERT INTO tipo_inventario (nombre,id_categoria) "
                        . "VALUES ('".$t->getNombre()."',"
                        . "".$t->getIdCategoria().");";
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
                $sql_str = "DELETE FROM tipo_inventario WHERE id = ".$id;
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
    
    public function modificar($inv,$id){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "UPDATE tipo_inventario SET "
                        . "nombre = '".$inv->getNombre()."',"
                        . "id_categoria = ".$inv->getIdCategoria()." "
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
    
}
