<?php
    $app->get('/plan_pagos/idOrden/:id', 'listaPlan');

    function listaPlan($id){
        $pDap = new Plan_pagosDAO();
        
        $res = $pDap->listaplan_porOrden($id);
        
        echo json_encode($res);
        //echo date("Y-m-d", strtotime("+1 month", strtotime("2014-10-31") )); 
    }

