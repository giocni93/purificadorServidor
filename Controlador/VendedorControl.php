<?php

$app->post('/vendedor','registrarvendedor');
$app->get('/vendedor', 'listaVendedor');

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