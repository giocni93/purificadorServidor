<?php

    $app->post('/planpago','guardarpago');
    $app->get('/planpago/idOrden/:id', 'listaPlan');

    function listaPlan($id){
        $pDap = new PlanpagoDAO();
        
        $res = $pDap->listaplan_porOrden($id);
        
        echo json_encode($res);
        //echo date("Y-m-d", strtotime("+1 month", strtotime("2014-10-31") )); 
    }
    

    function guardarpago(){
        
        
        
        
        $plaDao = new PlanPagoDao();
        $pl = new PlanPago();
        $fechainstalacion = new DateTime();
        $orden = new Orden_pedidoDAO();
        
        $id_orden_pedido = $orden->capturaID();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos

        $pl->setNumero_cuota($p->numero_cuota);
        
        $pl->setTipo($p->tipo);
        $pl->setMonto($p->monto);
        
        $pl->setFecha_credito($fechainstalacion->format('Y-m-d'));
        $pl->setId_orden_pedido($id_orden_pedido->getId());
        
        
        $plan = $plaDao->RegistrarPlanPago($pl);
        
        $max = $plaDao->capturaMaxID();
        $detalle_plan_pago = new Detalle_PlanPagoDAO();
        $fecha = new DateTime();
        $vlCuota = $p->valorCuota;
        
        
        for($i=0; $i<$pl->getNumero_cuota(); $i++){
           $d = new Detalle_PlanPago();
           $d->setFechaVencimiento(date("Y-m-d", strtotime("+".$i." month", strtotime($fecha->format('Y-m-d')) )));
           $d->setValorCuota($vlCuota);
           $d->setEstado(0);
           $d->setIdPlanPago($max);
           
           $detalle_plan_pago->RegistrarDetallePlanPago($d);
        }
        
        

        echo json_encode(array("estado"=>$plan));

    }