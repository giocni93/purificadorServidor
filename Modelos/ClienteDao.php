<?php

class ClienteDao {

    public function RegistrarCliente($pu){
        
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into cliente (cedula,nombre,apellido,direccion_oficina,direccion_casa,telefono,email,labor) "
                    ."values("
                    . "'" .$pu->getCedula() ."',"
                    . "'" .$pu->getNombre() ."',"
                    . "'" .$pu->getApellido() ."',"
                    . "'" .$pu->getDireccion_oficina() ."',"
                    . "'" .$pu->getDireccion_casa()."',"
                    . "'" .$pu->getTelefono() ."',"
                    . "'" .$pu->getEmail() ."',"
                    . "'" .$pu->getLabor() ."');";
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
                        "email" =>$cli->getEmail(),
                        "direccion_casa" =>$cli->getDireccion_casa(),
                        "labor" =>$cli->getLabor()
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
    
    public function listaClientesMan(){
            $conn = new Conexion();
            $listaCli = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT c.*,MAX(m.fecha_realizacion) as fecha,op.fecha as fechaPedido  
                    FROM cliente c 
                    LEFT JOIN orden_pedido op ON (c.cedula = op.id_cliente) 
                    LEFT JOIN mantenimiento m ON (m.id_orden_pedido = op.id)
                    GROUP BY cedula";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                $f = new DateTime();
                $fecha_f = $f->format('Y-m-d');
                foreach ($resultado as $row) {
		    $cli = new Cliente();
                    $cli->mapear($row);
                    $estado = "<p style='color:green; margin: 0;'>Al dia</p>";
                    if($row['fecha'] != null){
                        if($this->meses_transcurridos($row['fecha'] , $fecha_f) >= 6){
                            $estado = "<p style='color:red; margin: 0;'>Vencido</p>";
                        }
                    }else{
                        if($row['fechaPedido'] != null){
                            if($this->meses_transcurridos($row['fechaPedido'] , $fecha_f) >= 6){
                                $estado = "<p style='color:red; margin: 0;'>Vencido</p>";
                            }
                        }else{
                            $estado = "--";
                        }
                    }
                    
                    $listaCli[] = array(
                        "cedula" => $cli->getCedula(),
                        "nombre" => $cli->getNombre(),
                        "apellido" => $cli->getApellido(),
                        "direccion_oficina" =>$cli->getDireccion_oficina(),
                        "telefono" =>$cli->getTelefono(),
                        "email" =>$cli->getEmail(),
                        "Estado"=>$estado
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
    
    function meses_transcurridos($fecha_i,$fecha_f)
    {
            $datetime1 = new DateTime($fecha_i);
            $datetime2 = new DateTime($fecha_f);
            
            $datetime1 = new DateTime($datetime1->format("Y-m-d"));
            $datetime2 = new DateTime($datetime2->format("Y-m-d"));
            
            $interval = $datetime1->diff($datetime2);
            return $interval->format('%m');
    }
    
    
}
