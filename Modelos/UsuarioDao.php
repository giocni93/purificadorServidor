<?php


class UsuarioDao {
    
    public function insertarUsuario($resul){
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into usuario (nombre,apellido,user,pass,id_rol) "
                    ."values("
                    . "'" .$resul->getNombre(). "',"
                    . "'".$resul->getApellido(). "',"
                    . "'".$resul->getUser()."',"
                    . "'".$resul->getPass()."',"
                    . "".$resul->getRol().");";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
    public function modificarUsuario($resul,$id){
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "UPDATE usuario SET "
                    . "nombre = '" .$resul->getNombre(). "',"
                    . "apellido = '".$resul->getApellido(). "',"
                    . "user = '".$resul->getUser()."',"
                    . "pass = '".$resul->getPass()."' "
                    . "WHERE id = ".$id;
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
    public function eliminarUsuario($id){
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "DELETE FROM usuario "
                    . "WHERE id = ".$id;
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }

    public function consultarusuario($us){
            $conn = new Conexion();
            $listaUser = 0;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT u.*,r.nombre as nom_rol,r.id as idRol FROM usuario u INNER JOIN rol r ON (r.id = u.id_rol) where user ='".$us->getUser()."' and pass = '".$us->getPass()."'";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
                    
                    $listaUser = 1;
                    session_start();
                    $_SESSION['user'] = $row['nombre']." ".$row['apellido'];
                    $_SESSION['rol'] = $row['nom_rol'];
                    $_SESSION['id_rol'] = $row['idRol'];
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
            $listaUser = -1;
        }
        $conn->desconectar();
        return $listaUser;
    }
    
    public function listausuario(){
            $conn = new Conexion();
            $listaUser = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT u.*,r.nombre as nombre_rol FROM usuario u INNER JOIN rol r ON (r.id = u.id_rol)";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $use = new Usuario();
                    $listaUser[] = array(
                        "Id"        => $row['id'],
                        "Nombre"    => $row['nombre'],
                        "Apellido"  => $row['apellido'],
                        "User"      => $row['user'],
                        "Rol"       => $row['nombre_rol']  
                    );
                    
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
            
        }
        $conn->desconectar();
        return $listaUser;
    }
    
    public function listarol(){
            $conn = new Conexion();
            $listaUser = null;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM rol;";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $use = new Usuario();
                    $listaUser[] = array(
                        "Id"        => $row['id'],
                        "Nombre"    => $row['nombre'] 
                    );
                    
		}
            }
            else{
                
            }
        }catch(Exception $ex){
            $this->msg_exception = $ex->getMessage();
            
        }
        $conn->desconectar();
        return $listaUser;
    }

    
}
