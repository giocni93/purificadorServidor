<?php
    
    $app->get('/mantenimiento/idOrden/:id', 'listaMan');
    $app->get('/mantenimiento/idCliente/:id', 'listaManExt');
    $app->get('/mantenimiento/idMan/:id', 'listaMan_id');
    $app->get('/mantenimiento/idManExt/:id', 'listaMan_idExt');
    $app->get('/mantenimiento/:id', 'getMan');
    $app->post('/mantenimiento/:idOrden', 'agregarMan');
    $app->put('/mantenimiento/:id/:idOrd', 'updateMan');
    $app->get('/tareas_hoy', 'tareasHoy');
    $app->post('/consultas', 'consultas');


    function listaMan($id){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->listaMantenimiento($id);
        
        echo json_encode($res);
    }
    function listaManExt($id){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->listaMantenimiento2($id);
        
        echo json_encode($res);
    }
    
    function tareasHoy(){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->tareas_hoy();
        
        echo json_encode($res);
    }
    
    function consultas(){
        $oDao = new MantenimientoDAO();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $fi = $p->fi;
        $ff = $p->ff;
        
        $res = $oDao->consultas($fi,$ff);
        
        echo json_encode($res);
    }
    
    function listaMan_id($id){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->listaMantenimiento_id($id);
        
        echo json_encode($res);
    }
    
    function listaMan_idExt($id){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->listaMantenimiento_id2($id);
        
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
        $m->setValorPagado($p->valorPagado);
        
        if($m->getValorPagado() == ""){
            $m->setValorPagado(0);
        }
        
        if($m->getFechaRealizacion() == ""){
            $m->setFechaRealizacion(null);
        }
        
        $res = $oDao->update($m,$id);
        
        echo json_encode($res);
        
        $mDao = new Orden_pedidoDAO();
        
        $idCliente = $mDao->orden_cli($idOrd);
        registrarHistoManUp($idCliente,$m->getObservacion(),$id);
        
        if($m->getValorPagado() != 0){
            registrarHistopagoMan($idCliente,$m->getValorPagado(),$id);
        }
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
        
        $res = $oDao->registrar($m,$idOrden,$p->idCliente);
        
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
        $h->setTipo("Matenimiento");
        
        $res = $hDao->registrar($h);
        
        //echo json_encode(array("estado"=>$res));

        //$fecha = new DateTime();
        //echo $fecha->format('Y-m-d H:i:s') . "\n";
        
        //echo date("Y-m-d h:i A", strtotime("2013-01-19 15:42:00"));
    }
    
    function registrarHistoMan2($id,$motivo)
    {
        $h = new Historico();
        $hDao = new HistoricoDAO();
        $fecha = new DateTime();

        $h->setFecha($fecha->format('Y-m-d H:i:s'));
        $h->setTitulo("Nueva orden de mantenimiento");
        $h->setObservacion("Se ha realizado una nueva orden de mantenimiento con el siguiente motivo: \n\n".$motivo);
        $h->setIdCliente($id);
        $h->setTipo("Matenimiento");
        
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
        $h->setTipo("Matenimiento");
        
        $res = $hDao->registrar($h);
        
        //echo json_encode(array("estado"=>$res));

        //$fecha = new DateTime();
        //echo $fecha->format('Y-m-d H:i:s') . "\n";
        
        //echo date("Y-m-d h:i A", strtotime("2013-01-19 15:42:00"));
    }
    
    function registrarHistopagoMan($id,$obs,$idMan)
    {
        $h = new Historico();
        $hDao = new HistoricoDAO();
        $fecha = new DateTime();

        $h->setFecha($fecha->format('Y-m-d H:i:s'));
        $h->setTitulo("Pago del mantenimiento # ".$idMan);
        $h->setObservacion("Se ha realizado un pago al mantenimiento # ".$idMan." con un valor de $".$obs);
        $h->setIdCliente($id);
        $h->setTipo("Pago matenimiento");
        
        $res = $hDao->registrar($h);
        
        //echo json_encode(array("estado"=>$res));

        //$fecha = new DateTime();
        //echo $fecha->format('Y-m-d H:i:s') . "\n";
        
        //echo date("Y-m-d h:i A", strtotime("2013-01-19 15:42:00"));
    }
