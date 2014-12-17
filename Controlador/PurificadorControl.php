<?php

    $app->get('/purificador/:val', 'listaPurificadores');
    $app->post('/purificador', 'guardarPurificador');
    $app->put('/purificador/:id', 'modificarPurificador');
    $app->delete('/purificador/:id', 'eliminarPurificador');
    
    function listaPurificadores($val)
    {
        $puDao = new PurificadorDAO();
        
        $listaPur = $puDao->listaPurificadores($val);
        
        echo json_encode($listaPur);
    }
    
    function guardarPurificador()
    {
        $puDao = new PurificadorDAO();
        $pu = new Purificador();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $listaPur = $puDao->listaPurificadores($val);
        
        echo json_encode($listaPur);
    }
    
    function b($val)
    {
        $puDao = new PurificadorDAO();
        
        $listaPur = $puDao->listaPurificadores($val);
        
        echo json_encode($listaPur);
    }
    
    function a($val)
    {
        $puDao = new PurificadorDAO();
        
        $listaPur = $puDao->listaPurificadores($val);
        
        echo json_encode($listaPur);
    }

