<?php
    $app->get('/orden_pedido/cliente/:cedula', 'listaOrd');

    function listaOrd($cedula){
        $oDao = new Orden_pedidoDAO();
        
        $res = $oDao->listaOrden_porCliente($cedula);
        
        echo json_encode($res);
        //echo date("Y-m-d", strtotime("+1 month", strtotime("2014-10-31") )); 
    }