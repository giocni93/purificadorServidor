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
            $sql = $conn->getConn()->prepare();
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
            $sql = $conn->getConn()->prepare();
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
            $sql = $conn->getConn()->prepare();
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
}
