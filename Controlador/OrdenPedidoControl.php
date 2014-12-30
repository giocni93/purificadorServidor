<?php

    $app->post('/ordenpedido','guardarpedido');
    
    function guardarpedido(){
        
        $ordeDao = new OrdenPedidoDao();
        $or = new OrdenPedido();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $or->setFecha($p->fecha);
        $or->setDescripcion($p->descripcion);
        $or->setId_cliente($p->id_cliente);
        $or->setId_inventario($p->id_inventario);
        $or->setFecha_instalacion($p->fecha_instalacion);
        
        $ped = $ordeDao->RegistrarOrdePedido($or);
        
        echo json_encode(array("estado"=>$ped));
        
    }
    


