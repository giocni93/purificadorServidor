<?php

$app->post('/planpago','guardarpago');

function guardarpago(){
        
        
    
        $plaDao = new PlanPagoDao();
        $pl = new PlanPago();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $pl->setTipo($p->tipo);
        $pl->setMonto($p->monto);
        $pl->setNumero_cuota($p->numero_cuota);
        $pl->setFecha_credito($p->fecha_credito);
        $pl->setId_orden_pedido($p->id_orden_pedido);
        
        $plan = $plaDao->RegistrarPlanPago($pl);
        
        echo json_encode(array("estado"=>$plan));
        
    }