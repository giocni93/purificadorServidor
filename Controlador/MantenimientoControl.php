<?php
    
    $app->get('/mantenimiento/idOrden/:id', 'listaMan');
    $app->get('/mantenimiento/idMan/:id', 'listaMan_id');
    $app->get('/mantenimiento/:id', 'getMan');
    $app->post('/mantenimiento/:idOrden', 'agregarMan');
    $app->put('/mantenimiento/:id', 'updateMan');


    function listaMan($id){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->listaMantenimiento($id);
        
        echo json_encode($res);
    }
    
    function listaMan_id($id){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->listaMantenimiento_id($id);
        
        echo json_encode($res);
    }
    
    function getMan($id){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->listaMan($id);
        
        echo json_encode($res);
    }
    
    function updateMan($id){
        $oDao = new MantenimientoDAO();
        $m = new Mantenimiento();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $m->setAsesor($p->asesor);
        $m->setFechaProgramada($p->fechaProgramada);
        $m->setCiudad($p->ciudad);
        $m->setMotivo($p->motivo);
        $m->setObservacion($p->observacion);
        $m->setNombreTecnico($p->nombreTecnico);
        $m->setFechaRealizacion($p->fechaRealizacion);
        
        $res = $oDao->update($m,$id);
        
        echo json_encode($res);
    }
    
    function agregarMan($idOrden){
        $oDao = new MantenimientoDAO();
        $m = new Mantenimiento();
        $fecha = new DateTime();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $m->setAsesor($p->asesor);
        $m->setFechaProgramada($p->fechaProgramada);
        $m->setCiudad($p->ciudad);
        $m->setMotivo($p->motivo);
        $m->setNombreTecnico($p->nombreTecnico);
        $m->setFecha($fecha->format('Y-m-d'));
        
        $res = $oDao->registrar($m,$idOrden);
        
        echo json_encode($res);
    }
