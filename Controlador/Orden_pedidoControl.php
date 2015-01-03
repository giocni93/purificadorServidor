<?php
    $app->get('/orden_pedido/cliente/:cedula', 'listaOrd');
    $app->post('/orden_pedido','guardarpedido');
    $app->get('/orden_pedido/idcedula/:id_cliente', 'imprimir_orden');
    
   

    function listaOrd($cedula){
        $oDao = new Orden_pedidoDAO();
        
        $res = $oDao->listaOrden_porCliente($cedula);
        
        echo json_encode($res);
        //echo date("Y-m-d", strtotime("+1 month", strtotime("2014-10-31") )); 
    }
    
    function guardarpedido(){
        
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