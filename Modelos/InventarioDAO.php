<?php


class InventarioDAO {
    
    public $msg_exception;
    
    public function registrar($inv){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "INSERT INTO inventario (nombre,cantidad,valor,imagen,id_tipo_inventario) "
                        . "VALUES ('".$inv->getNombre()."',"
                        . "".$inv->getCantidad().","
                        . "".$inv->getValor().","
                        . "'".$inv->getImagen()."',"
                        . "".$inv->getId_tipo_inventario().");";
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
    
    public function precio($id){
        $conn = new Conexion();
        $listaTip = null;
        try{
            if($conn->conectar()){
                $sql_str = "select * from inventario where id =".$id;
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $t = new Inventario();
                    $t->mapear($row);
                    
                    $listaTip[] = array(
                        "valor"  => $t->getValor()
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
    
    public function inventario($idtipo){
        $conn = new Conexion();
        $listaTip = null;
        try{
            if($conn->conectar()){
                $sql_str = "Select * from inventario where id_tipo_inventario = $idtipo";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $t = new Inventario();
                    $t->mapear($row);
                    
                    $listaTip[] = array(
                        "id"        => $t->getId(),
                        "nombre"    => $t->getNombre(),
                        "valor"     => $t->getValor()
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
    
    public function listaInv(){
        $conn = new Conexion();
        $listaInv = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT i.*,t.nombre as tipo FROM inventario as i INNER JOIN tipo_inventario as t "
                        . "ON (i.id_tipo_inventario = t.id);";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $cat = new Inventario();
                    $cat->mapear($row);
                    
                    $listaInv[] = array(
                        "Id"            => $cat->getId(),
                        "Nombre"        => $cat->getNombre(),
                        "Cantidad"      => $cat->getCantidad(),
                        "Valor"         => $cat->getValor(),
                        "Imagen"        => $cat->getImagen(),
                        "Tipo"          => $row['tipo']
                    );
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
        }
        $conn->desconectar();
        return $listaInv;
    }
    
    public function borrar($id){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "DELETE FROM inventario WHERE id = ".$id;
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
                $sql_str = "UPDATE inventario SET "
                        . "nombre = '".$inv->getNombre()."',"
                        . "cantidad = ".$inv->getCantidad().","
                        . "valor = ".$inv->getValor().","
                        . "imagen = '".$inv->getImagen()."',"
                        . "id_tipo_inventario = ".$inv->getId_tipo_inventario()." "
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
