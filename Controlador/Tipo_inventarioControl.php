<?php

    $app->get('/tipoInventario/:idCat', 'listaTipos');
    $app->get('/tipoInventario', 'listaTiposTodos');
    $app->post('/tipoInventario', 'registrarTip');
    
    function listaTipos($idCat){
        
        $tDao = new Tipo_inventarioDAO();
        
        $res = $tDao->listaTipo_inv($idCat);
        
        echo json_encode($res);

    }
    
    function listaTiposTodos(){
        
        $tDao = new Tipo_inventarioDAO();
        
        $res = $tDao->lista();
        
        echo json_encode($res);
        
    }
    
    function registrarTip(){
        $tDao = new Tipo_inventarioDAO();
        $t = new Tipo_inventario();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $t->setNombre($p->nombre);
        $t->setIdCategoria($p->idCategoria);
        
        $res = $tDao->registrar($t);
        
        echo json_encode(array("estado"=>$res));
    }
