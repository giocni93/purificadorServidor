<?php
    $app->get('/orden_pedido/cliente/:cedula', 'listaOrd');
    $app->post('/orden_pedido','guardarpedido');
    $app->get('/orden_pedido/idcedula/:id_cliente', 'imprimir_orden');
    $app->get('/orden_pedido/clienteMan/:cedula', 'listaOrdMan');
    $app->get('/orden_pedido/idOrden/:id', 'listaOrdenFull');
    $app->get('/ordenpedido','lista_mod_fecha');
    $app->put('/ordenpedido/:id','update_date');
    
    function update_date($id){
        
        $op = new Orden_pedido();
        $oDao = new Orden_pedidoDAO();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $op->setFechaInstalacion($p->fechaInstalacion);
        $res = $oDao->update_date($id, $op);
        
        echo json_encode(array("estado"=>$res));
    }
    
    function lista_mod_fecha(){
        $oDao = new Orden_pedidoDAO();
        
        $res = $oDao->lista_mod_fecha();
        
        echo json_encode($res);
    }

    function listaOrd($cedula){
        $oDao = new Orden_pedidoDAO();
        
        $res = $oDao->listaOrden_porCliente($cedula);
        
        echo json_encode($res);
        //echo date("Y-m-d", strtotime("+1 month", strtotime("2014-10-31") )); 
    }
    
    function listaOrdenFull($id){
        $oDao = new Orden_pedidoDAO();
        
        $res = $oDao->orden_cli($id);
        
        echo json_encode($res);
        //echo date("Y-m-d", strtotime("+1 month", strtotime("2014-10-31") )); 
    }
    
    function listaOrdMan($cedula){
        $oDao = new Orden_pedidoDAO();
        
        $res = $oDao->listaOrden_porClienteMan($cedula);
        
        echo json_encode($res);
    }
    
    function guardarpedido(){
        
        $man = new Mantenimiento();
        $manDao = new MantenimientoDAO();
        
        $fecha = new DateTime();
        
        $ordeDao = new Orden_pedidoDAO();
        $or = new Orden_pedido();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $or->setFecha($fecha->format('Y-m-d'));
        $or->setDescripcion($p->descripcion);
        $or->setIdCliente($p->idcliente);
        $or->setIdInventario($p->idinventario);
        $or->setFechaInstalacion($p->fechainstalacion);
        
        $ped = $ordeDao->RegistrarOrdePedido($or);
        
        $maxID = $ordeDao->capturaID();
        
        $man->setAsesor("");
        $man->setFecha($fecha->format('Y-m-d'));
        $man->setFechaProgramada(date("Y-m-d",  strtotime("+ 3 month",  strtotime($fecha->format('Y-m-d')))));
        $man->setNombreTecnico("");
        $man->setMotivo("");
        $man->setCiudad("");
        
        $manDao->registrar($man, $maxID->getId(),null);
        
        echo json_encode(array("estado"=>$ped));
        
    }
    
    function imprimir_orden($id_cliente){
        
        $oDao = new Orden_pedidoDAO();
        
        $res = $oDao->Imprimir_orden_instalacion($id_cliente);
        
        echo json_encode($res);
        
        
        //$this->pdf = new pdf();
        //$this->pdf->AddPage();
        //$this->pdf->Cell(30);
	//$this->pdf->Cell(120,-5,'INFORME DE PLANILLA',0,0,'C');
        
    }