<?php

    $app->post('/inventario', 'registrarInv');
    $app->get('/inventario', 'listaInv');
    
    function registrarInv()
    {
        $i = new Inventario();
        $iDao = new InventarioDAO();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
       
        
        $i->setNombre($p->nombre);
        $i->setCantidad($p->cantidad);
        $i->setValor($p->valor);
        $i->setImagen($p->imagen);
        $i->setId_tipo_inventario($p->idTipo);
        
        $res = $iDao->registrar($i);
        
        echo json_encode(array("estado"=>$res));

    }
    
    function listaInv()
    {
        $iDao = new InventarioDAO();

        $res = $iDao->listaInv();
        
        echo json_encode($res);

    }