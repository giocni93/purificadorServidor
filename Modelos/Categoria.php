<?php

class Categoria {
    
    private $id;
    private $nombre;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    function mapear($row){
        $this->id       = $row['id'];
        $this->nombre   = $row['nombre'];
    }
    
}
