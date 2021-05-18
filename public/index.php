<?php
require_once("../vendor/autoload.php");
require_once("../src/utils/functions.php");

use Source\controller\UsuariosController;
use Source\utils\ConexaoBD;

$uri = explode('/', (string) $_SERVER['REQUEST_URI'])[1];

try{
  switch ($uri){
    case 'home':
        $controlador = new UsuariosController();
        $action=$_GET["action"];

        if(empty($action)){
          $controlador->indexAction();
        }else{
          $controlador->{$action}();
        }
        
        break;
    default:
        http_response_code(404);
        break;
  }

}catch(Exception $e){
  echo $e->getMessage();
}