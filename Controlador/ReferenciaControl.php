<?php

    $app->post('/referencia', 'guardarreferencia');
    $app->get('/referencia/:id','consultarreferencia');
    $app->get('/referencia','listaRef');
    $app->put('/referencia/:id','modificarreferencia');
    $app->delete('/referencia/:id', 'borrarReferencia');
    
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
    
    function consultarreferencia($id){
        
        $conRef = new ReferenciaDao();
        
        $consulta = $conRef->listaReferencia($id);
        
        echo json_encode($consulta);
        
    }
    
    function listaRef(){
        
        $conRef = new ReferenciaDao();
        
        $consulta = $conRef->listaRef();
        
        echo json_encode($consulta);
        
    }
    
    function borrarReferencia($id){
        
        $cDao = new ReferenciaDao();

        $res = $cDao->borrar($id);
        
        echo json_encode(array("estado"=>$res));
        
    }
    
   
   function modificarreferencia($id){
       
        $c = new Referencia();
        $cDao = new ReferenciaDao();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        
        $c->setNombre($p->nombre);
        $c->setTelefono($p->telefono);
        
        $res = $cDao->ModificarReferencia($c, $id);
        
        echo json_encode(array("estado"=>$res));
       
   }
