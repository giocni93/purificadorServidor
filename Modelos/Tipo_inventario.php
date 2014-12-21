<?php

class Tipo_inventario {
    
    private $id;
    private $nombre;
    private $idCategoria;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }


    function mapear($row){
        $this->id           = $row['id'];
        $this->nombre       = $row['nombre'];
        $this->idCategoria  = $row['id_categoria'];
    }
    
}
