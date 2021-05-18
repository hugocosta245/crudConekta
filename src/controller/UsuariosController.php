<?php

namespace Source\controller;

use Source\model\UsuarioModel;

class UsuariosController
{
    public function indexAction(){
        $titulo = 'Lista de Usuarios';
        require_once("../src/view/Home.php");
    }

    public function buscarUsuarios(){
        $usuarios = UsuarioModel::getUsuers();
        echo json_encode($usuarios);
    }
}