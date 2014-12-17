<?php

    include_once 'Slim/Slim.php';

    \Slim\Slim::registerAutoloader();
    $app = new \Slim\Slim();

    include_once 'Conexion/conexion.php';
    
    include_once 'Modelos/Purificador.php';
    include_once 'Modelos/PurificadorDAO.php';
    
    include_once 'Controlador/PurificadorControl.php';


    $app->run();
    
?>