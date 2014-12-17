<?php

    class conexion
    {
        private $host;
        private $db;
        private $user;
        private $pass;

        private $conn;

        function __construct() {
            $this->host		= 'localhost';
            $this->db		= 'purificadores';
            $this->user 	= 'root';
            $this->pass		= '';
        }

        public function getConn(){
            return $this->conn;
        }

        public function conectar(){
            try{
                $urlConexion = "mysql:host=".$this->host.";dbname=".$this->db;
                $this->conn = new PDO($urlConexion, $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return true;
            }catch(PDOException $e){
                return false;
            }
        }

        public function desconectar(){
            $this->conn = null;
        }		

    }

?>
