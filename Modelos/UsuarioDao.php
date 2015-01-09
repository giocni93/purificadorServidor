<?php


class UsuarioDao {

    public function consultarusuario($us){
            $conn = new Conexion();
            $listaUser = 0;
        try{
            if($conn->conectar()){
                $sql_str = "SELECT * FROM usuario where user ='".$us->getUser()."' and pass = '".$us->getPass()."'";
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();
                foreach ($resultado as $row) {
		    $use = new Usuario();
                    $use->mapear($row);
                    
                    $listaUser = 1;
                    session_start();
                    $_SESSION['user'] = $us->getUser();
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
    
    public function insertarusuario($u){
        $conn = new conexion();
        $resultado = -1;

        if($conn->conectar()){
            
            $sql_str = "Insert into usuario (user,pass) "
                    ."values("
                    . "'" .$u->getUser(). "',"
                    . "'" .$u->getPass(). "');";
            $sql = $conn->getConn()->prepare($sql_str);
            $resultado = $sql->execute();
        }
        else{
            $this->msgError = "error al conectar con la base de datos";
        }
        $conn->desconectar();
        return $resultado;
    }
    
}
