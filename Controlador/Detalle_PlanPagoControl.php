<?php

    $app->put('/detalle_planpago/:id', 'updateDet');
    
    function updateDet($id){
        $d = new Detalle_PlanPago();
        $dDao = new Detalle_PlanPagoDAO();
        $fecha = new DateTime();

        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        $idCliente = $p->idCliente;
        $idOrd = $p->idOrd;
        $numCuota = $p->numCuota;
        $val = $p->val;
        
        $d->setFechaPagado($fecha->format('Y-m-d'));
        $d->setEstado(true);
        
        $res = $dDao->modificar($d,$id);
        
        registrarHisto($idCliente,$idOrd,$numCuota,$val);
        
        echo json_encode(array("estado"=>$res));
    }

    
    function registrarHisto($id,$idOrd,$numCuota,$val)
    {
        $h = new Historico();
        $hDao = new HistoricoDAO();
        $fecha = new DateTime();

        $h->setFecha($fecha->format('Y-m-d H:i:s'));
        $h->setTitulo("Pago de la cuota # ".$numCuota);
        $h->setObservacion("Se ha realizado el pago de la cuota correspondiente al orden de "
                          ."pedido # ".$idOrd." por valor de $".$val);
        $h->setIdCliente($id);
        
        $res = $hDao->registrar($h);
        
        //echo json_encode(array("estado"=>$res));

        //$fecha = new DateTime();
        //echo $fecha->format('Y-m-d H:i:s') . "\n";
        
        //echo date("Y-m-d h:i A", strtotime("2013-01-19 15:42:00"));
    }
