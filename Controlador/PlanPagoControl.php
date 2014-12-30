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