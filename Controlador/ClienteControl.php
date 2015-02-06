<?php

$app->post('/cliente', 'guardarcliente');
$app->post('/cliente/mantenimiento', 'guardarclienteMan');
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
        $c->setLabor($p->labor);
        
        $clien = $cliDao->RegistrarCliente($c);
        
        echo json_encode(array("estado"=>$clien));
        
    }
    
    function guardarclienteMan()
    {
        $cliDao = new ClienteDao();
        $c = new Cliente();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $c->setCedula($p->cedula);
        $c->setNombre($p->nombre);
        $c->setApellido($p->apellido);
        $c->setDireccion_oficina(null);
        $c->setDireccion_casa($p->direccion);
        $c->setTelefono($p->telefono);
        $c->setEmail($p->correo);
        $c->setLabor(null);
        
        $clien = $cliDao->RegistrarCliente($c);
        $banRegi = 0;
        if($clien != 0){
            $oDao = new MantenimientoDAO();
            $m = new Mantenimiento();
            $fecha = new DateTime();

            $m->setAsesor($p->asesor);
            $m->setFechaProgramada($p->fechaProgramada);
            $m->setCiudad($p->ciudad);
            $m->setMotivo($p->motivo);
            $m->setNombreTecnico($p->nombreTecnico);
            $m->setFecha($fecha->format('Y-m-d'));

            $res = $oDao->registrar2($m,$p->cedula);

            if($res == 1){
                $banRegi = 1;
            }

            $idCliente = $p->cedula;
            registrarHistoMan2($idCliente,$m->getMotivo());
        }
        
        echo json_encode(array("estado"=>$banRegi));
        
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
