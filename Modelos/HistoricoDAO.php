<?php

class HistoricoDAO {
    
    public $msg_exception;
    
    public function registrar($h){
        $conn = new Conexion();
        $res = -1;
        try{
            if($conn->conectar()){
                $sql_str = "INSERT INTO historico (fecha,titulo,observacion,id_cliente,tipo) "
                        . "VALUES ('".$h->getFecha()."',"
                        . "'".$h->getTitulo()."',"
                        . "'".nl2br($h->getObservacion())."',"
                        . "'".$h->getIdCliente()."',"
                        . "'".$h->getTipo()."');";
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
    
    public function listaHis_porCliente($cedula){
        $conn = new Conexion();
        $listaHis = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM historico WHERE id_cliente = '".$cedula."' ORDER BY fecha DESC";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $h = new Historico();
                    $h->mapear($row);
                    
                    $listaHis[] = array(
                        "Id"            => $h->getId(),
                        "Fecha"         => date("Y-m-d h:i A", strtotime($h->getFecha())),
                        "Titulo"        => $h->getTitulo(),
                        "Observacion"   => $h->getObservacion(),
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
        return $listaHis;
    }
    
}
