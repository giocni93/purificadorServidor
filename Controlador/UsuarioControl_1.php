<?php

$app->post('/usuario','consultarusuario');
$app->post('/usuarioguardar','guardarusuario');

function consultarusuario(){
        
        $conUser = new UsuarioDao();
        $us = new Usuario();
        
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $us->setUser($p->user);
        $us->setPass($p->pass);
        
        $consulta = $conUser->consultarusuario($us);
        
        echo json_encode($consulta);
        
}

function guardarusuario()
    {
        $usuDao = new UsuarioDao();
        $u = new Usuario();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $u->setUser($p->user);
        $u->setPass($p->pass);
        
        $clien = $usuDao->insertarusuario($u);
        
        echo json_encode(array("estado"=>$clien));
        
    }

