<?php

    $app->get('/categoria', 'listaCategoria');
    $app->post('/categoria', 'registrarCat');
    
    function listaCategoria()
    {
        $cDao = new CategoriaDAO();
        
        $res = $cDao->listaCategorias();
        
        echo json_encode($res);

    }
    
    function registrarCat()
    {
        $cDao = new CategoriaDAO();
        $c = new Categoria();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $c->setNombre($p->nombre);
        
        $res = $cDao->registrar($c);
        
        echo json_encode(array("estado"=>$res));

    }

