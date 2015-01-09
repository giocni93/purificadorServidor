<?php

$app->post('/codeudor', 'guardarcodeudor');
$app->get('/codeudor/:id','consultarcodeudor');
$app->put('/codeudor/:id','modificarcodeudor');
$app->delete('/codeudor/:id', 'borrarCodeudor');

function guardarcodeudor()
    {
        $coDao = new CodeudorDao();
        $co = new Codeudor();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        
        $co->setCedula($p->cedula);
        $co->setNombre($p->nombre);
        $co->setDireccion_oficina($p->direccion_oficina);
        $co->setTelefono($p->telefono);
        $co->setReferencia($p->referencia);
        $co->setTelefono_referencia($p->telefono_referencia);
        $co->setId_cliente($p->id_cliente);
        
        $code = $coDao->RegistrarCodeudor($co);
        
        echo json_encode(array("estado"=>$code));
        
    }
    
    function modificarcodeudor($id){
        
        $c = new Codeudor();
        $cDao = new CodeudorDao();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        
        $c->setNombre($p->nombre);
        $c->setDireccion_oficina($p->direccion_oficina);
        $c->setTelefono($p->telefono);
        $c->setReferencia($p->referencia);
        $c->setTelefono_referencia($p->telefono_referencia);
        
        
        $res = $cDao->ModificarCodeudor($c, $id);
        
        echo json_encode(array("estado"=>$res));
        
    }
    
    function borrarCodeudor($id){
        
        $cDao = new CodeudorDao();

        $res = $cDao->borrar($id);
        
        echo json_encode(array("estado"=>$res));
        
    }
    

    function consultarcodeudor($id){
        
        $conCod = new CodeudorDao();
        
        $consulta = $conCod->listaCodeudor($id);
        
        echo json_encode($consulta);
        
    }