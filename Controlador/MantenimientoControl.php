<?php
    
    $app->get('/mantenimiento/idOrden/:id', 'listaMan');
    $app->get('/mantenimiento/idMan/:id', 'listaMan_id');
    $app->get('/mantenimiento/:id', 'getMan');
    $app->post('/mantenimiento/:idOrden', 'agregarMan');
    $app->put('/mantenimiento/:id/:idOrd', 'updateMan');


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
    
    function updateMan($id,$idOrd){
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
        
        $mDao = new Orden_pedidoDAO();
        
        $idCliente = $mDao->orden_cli($idOrd);
        registrarHistoManUp($idCliente,$m->getObservacion(),$id);
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
        
        $mDao = new Orden_pedidoDAO();
        
        $idCliente = $mDao->orden_cli($idOrden);
        registrarHistoMan($idCliente,$idOrden,$m->getMotivo());
    }
    
    function registrarHistoMan($id,$idOrd,$motivo)
    {
        $h = new Historico();
        $hDao = new HistoricoDAO();
        $fecha = new DateTime();

        $h->setFecha($fecha->format('Y-m-d H:i:s'));
        $h->setTitulo("Nueva orden de mantenimiento");
        $h->setObservacion("Se ha realizado una nueva orden de mantenimiento correspondiente al "
                . "orden de pedido # ".$idOrd." con el siguiente motivo: \n\n".$motivo);
        $h->setIdCliente($id);
        
        $res = $hDao->registrar($h);
        
        //echo json_encode(array("estado"=>$res));

        //$fecha = new DateTime();
        //echo $fecha->format('Y-m-d H:i:s') . "\n";
        
        //echo date("Y-m-d h:i A", strtotime("2013-01-19 15:42:00"));
    }
    
    function registrarHistoManUp($id,$obs,$idMan)
    {
        $h = new Historico();
        $hDao = new HistoricoDAO();
        $fecha = new DateTime();

        $h->setFecha($fecha->format('Y-m-d H:i:s'));
        $h->setTitulo("Actualizacion mantenimiento # ".$idMan);
        $h->setObservacion("Se ha actualizado los resultados del mantenimiento # ".$idMan." especificando la siguiente "
                . "observacion: \n\n".$obs);
        $h->setIdCliente($id);
        
        $res = $hDao->registrar($h);
        
        //echo json_encode(array("estado"=>$res));

        //$fecha = new DateTime();
        //echo $fecha->format('Y-m-d H:i:s') . "\n";
        
        //echo date("Y-m-d h:i A", strtotime("2013-01-19 15:42:00"));
    }
