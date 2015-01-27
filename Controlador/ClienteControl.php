<?php

$app->post('/cliente', 'guardarcliente');
$app->get('/consultarcliente','consultarcliente');
$app->put('/modificarcliente/:ced','modificarcliente');
$app->delete('/cliente/:id', 'borrarCliente');
$app->get('/cliente/mantenimiento','clienteMantenimiento');

function clienteMantenimiento(){
    $conCli = new ClienteDao();
        
    $consulta = $conCli->listaClientesMan();

    echo json_encode($consulta);
}

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
        $c->setDireccion_casa($p->direccion_casa);
        $c->setTelefono($p->telefono);
        $c->setEmail($p->email);
        
        $clien = $cliDao->RegistrarCliente($c);
        
        echo json_encode(array("estado"=>$clien));
        
    }
    
    function modificarcliente($ced){
        
        $c = new Cliente();
        $cDao = new ClienteDao();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        
        $c->setNombre($p->nombre);
        $c->setApellido($p->apellido);
        $c->setDireccion_oficina($p->direccion_oficina);
        $c->setTelefono($p->telefono);
        $c->setEmail($p->email);
        
        $res = $cDao->ModificarCliente($c, $ced);
        
        echo json_encode(array("estado"=>$res));
        
    }


    function consultarcliente(){
        
        $conCli = new ClienteDao();
        
        $consulta = $conCli->listaClientes();
        
        echo json_encode($consulta);
        
    }

    function borrarCliente($id){
        
        $cDao = new ClienteDao();

        $res = $cDao->borrar($id);
        
        echo json_encode(array("estado"=>$res));
        
    }
