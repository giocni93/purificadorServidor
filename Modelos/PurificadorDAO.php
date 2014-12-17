<?php

class PurificadorDAO {
    
    public $msgError;
    
    public function guardarPurificador($pu){
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into purificador(nombre,cantidad,valor) "
                    + "values("
                    + "'"+$pu->getNombre()+"',"
                    + ""+$pu->getCantidad()+","
                    + ""+$pu->getValor()+");";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
    public function modificarPurificador($pu,$id){
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "UPDATE purificador set "
                    + "nombre = '" + $pu->getNombre() + "',"
                    + "cantidad = " + $pu->getCantidad() + ","
                    + "valor = " + $pu->getValor() + " "
                    + "WHERE id = " + $id + ";";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
    public function eliminarPurificador($id){
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "DELETE FROM purificador WHERE "
                    + "id = " + $id + ";";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
    public function listaPurificadores($val){
        $conn = new conexion();
        $arrayPurificadores = null;

        if($conn->conectar()){

            $sql_str = "SELECT * FROM purificador WHERE "
                    + "id LIKE '%" + $val +"%' OR "
                    + "nombre LIKE '%" + $val + "%' OR "
                    + "cantidad LIKE '%" + $val + "%' OR "
                    + "valor LIKE '%" + $val + "%';";
            
            $sql = $conn->getConn()->prepare($sql_str);
            $sql->execute();
            $resultado = $sql->fetchAll();
            foreach ($resultado as $row) {
                $pu = new Purificador();
                $pu ->mapear($row);
                $arrayPurificadores[] = array(
                    "Id"        => $pu->getId(),
                    "Nombre"    => $pu->getNombre(),
                    "Cantidad"  => $pu->getCantidad(),
                    "Valor"     => $pu->getValor(),
                );
            }
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $arrayPurificadores;
    }
    
}
