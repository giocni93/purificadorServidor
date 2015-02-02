<?php

$app->post('/vendedor', 'registrarvendedor');
$app->get('/vendedor',  'listaVendedor');
$app->put('/vendedor/:ced',  'modificarvendedor');
$app->delete('/vendedor/:ced','borrarVendedor');

function registrarvendedor(){
    $vendedor = new VendedorDao();
    $v = new Vendedor();
    
    $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
    $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
    
    $v->setCedula($p->cedula);
    $v->setNombres($p->nombres);
    $v->setApellidos($p->apellidos);
    $v->setTelefono($p->telefono);
    
    $ven = $vendedor->insertarvendedor($v);
    
    echo json_encode(array("estado"=>$ven));
    
}

function listaVendedor()
{
        $vDao = new VendedorDao();
        
        $res = $vDao->listaVendedores();
        
        echo json_encode($res);

}

function borrarVendedor($ced){
        
        $vDao = new VendedorDao();

        $res = $vDao->borrar($ced);
        
        echo json_encode(array("estado"=>$res));
        
    }

function modificarvendedor($ced){
       
        $v = new Vendedor();
        $vDao = new VendedorDao();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        
        $v->setNombres($p->nombres);
        $v->setApellidos($p->apellidos);
        $v->setTelefono($p->telefono);
        
        $res = $vDao->ModificarVendedor($v, $ced);
        
        echo json_encode(array("estado"=>$res));
       
   }