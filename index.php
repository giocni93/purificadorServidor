<?php

    include_once 'Slim/Slim.php';

    \Slim\Slim::registerAutoloader();
    $app = new \Slim\Slim();

    include_once 'Conexion/conexion.php';
    
    include_once 'Modelos/Inventario.php';
    include_once 'Modelos/Categoria.php';
    include_once 'Modelos/Tipo_inventario.php';
    
    include_once 'Modelos/InventarioDAO.php';
    include_once 'Modelos/CategoriaDAO.php';
    include_once 'Modelos/Tipo_inventarioDAO.php';
    
    include_once 'Controlador/InventarioControl.php';
    include_once 'Controlador/CategoriaControl.php';
    include_once 'Controlador/Tipo_inventarioControl.php';


    $app->run();
