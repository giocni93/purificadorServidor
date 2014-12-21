<?php

$app->post('/cliente', 'guardarcliente');
$app->get('/consultarcliente/:val','consultarcliente');

function guardarcliente()
    {
        $cliDao = new ClienteDao();
        $c = new Cliente();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $c->setCedula($p->cedula);
        $c->setNombre($p->nombre);
        $c->setApellido($p->apellido);
        $c->setDireccion_oficina($p->direccion_oficina);
        $c->setTelefono($p->telefono);
        $c->setEmail($p->email);
        
        $clien = $cliDao->RegistrarCliente($c);
        
        echo json_encode(array("estado"=>$clien));
        
    }
    
    function consultarcliente($val){
        
        $conCli = new ClienteDao();
        
        $consulta = $conCli->listaClientes($val);
        
        echo json_encode(array("consulta"=>$consulta));
        
    }

    
