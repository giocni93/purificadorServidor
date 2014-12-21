<?php

$app->post('/codeudor', 'guardarcodeudor');

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
