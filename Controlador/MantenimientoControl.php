<?php
    
    $app->get('/mantenimiento/idOrden/:id', 'listaMan');


    function listaMan($id){
        $oDao = new MantenimientoDAO();
        
        $res = $oDao->listaMantenimiento($id);
        
        echo json_encode($res);
    }
