<?php

    $app->get('/categoria', 'listaCategoria');
    $app->post('/categoria', 'registrarCat');
    $app->delete('/categoria/:id', 'borrarCat');
    $app->put('/categoria/:id', 'updateCat');
    
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
    
    function borrarCat($id){
        $cDao = new CategoriaDAO();

        $res = $cDao->borrar($id);
        
        echo json_encode(array("estado"=>$res));
    }
    
    function updateCat($id){
        $c = new Categoria();
        $cDao = new CategoriaDAO();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos

        $c->setNombre($p->nombre);
        
        $res = $cDao->modificar($c,$id);
        
        echo json_encode(array("estado"=>$res));
    }

