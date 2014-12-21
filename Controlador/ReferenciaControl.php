<?php

    $app->post('/referencia', 'guardarreferencia');
    
    
    function guardarreferencia()
    {
        $refDao = new ReferenciaDao();
        $re = new Referencia();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        
        for ($i = 0 ; $i < count($p) ; $i ++) {
            $re->setNombre($p[$i]->nombre);
            $re->setTelefono($p[$i]->telefono);
            $re->setId_cliente($p[$i]->id_cliente);
            
            $ref = $refDao->RegistrarReferencia($re);
        }
        
        echo json_encode(array("estado"=>$ref));  

    }
