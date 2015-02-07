<?php

$app->post('/usuario','consultarusuario');
$app->post('/usuario/registro','guardarusuario');
$app->put('/usuario/:id','modificarusuario');
$app->delete('/usuario/:id','borrarusuario');
$app->get('/usuario','listausuario');
$app->get('/usuario/rol','listarol');

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
    function listausuario(){
        $conUser = new UsuarioDao();
        
        $consulta = $conUser->listausuario();
        
        echo json_encode($consulta);
    }
    
    function listarol(){
        $conUser = new UsuarioDao();
        
        $consulta = $conUser->listarol();
        
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
        $u->setNombre($p->nombre);
        $u->setApellido($p->apellido);
        $u->setRol($p->rol);
        
        $clien = $usuDao->insertarUsuario($u);
        
        echo json_encode(array("estado"=>$clien));
        
    }
    
    function modificarusuario($id)
    {
        $usuDao = new UsuarioDao();
        $u = new Usuario();
        $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
        $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos
        
        $u->setUser($p->user);
        $u->setPass($p->pass);
        $u->setNombre($p->nombre);
        $u->setApellido($p->apellido);
        
        $clien = $usuDao->modificarUsuario($u,$id);
        
        echo json_encode(array("estado"=>$clien));
        
    }
    
    function borrarusuario($id)
    {
        $usuDao = new UsuarioDao();
        
        $clien = $usuDao->eliminarUsuario($id);
        
        echo json_encode(array("estado"=>$clien));
        
    }

