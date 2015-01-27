<?php
    
    $app->post('/historico', 'registrarHis');
    $app->get('/historico/cliente/:cedula', 'listaHis');
    
    function registrarHis()
    {
        $h = new Historico();
        $hDao = new HistoricoDAO();
        $fecha = new DateTime();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos

        $h->setFecha($fecha->format('Y-m-d H:i:s'));
        $h->setTitulo($p->titulo);
        $h->setObservacion($p->observacion);
        $h->setIdCliente($p->idCliente);
        $h->setTipo($p->tipo);
        
        $res = $hDao->registrar($h);
        
        echo json_encode(array("estado"=>$res));

        //$fecha = new DateTime();
        //echo $fecha->format('Y-m-d H:i:s') . "\n";
        
        //echo date("Y-m-d h:i A", strtotime("2013-01-19 15:42:00"));
    }
    
    function listaHis($cedula){
        $hDao = new HistoricoDAO();
        
        $res = $hDao->listaHis_porCliente($cedula);
        
        echo json_encode($res);
    }
    
