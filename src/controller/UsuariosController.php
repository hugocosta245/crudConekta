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
    public function addUsuarios(){

        $response = $this->ValidacaoCampos($_POST);

        if ($response['result'] == 'erro' ) {
            echo json_encode($response);
        }
       
        if (UsuarioModel::addUsuer($response['data'])) {

            echo json_encode($response);
        } else {

            echo json_encode(array(
                "result" => "erro",
                "campo" => "CPF",
                "messagem" => "CPF Invalido!",
            ));
        }
    }
    public function deleteUsuarios(){       

        $response = $this->ValidacaoDelete($_POST);

        if ($response['result'] == 'erro' ) {

            echo json_encode($response);
        } 

        $result = UsuarioModel::buscaPorIdUsuer($response['data']['idDelete']);
       
        if (!UsuarioModel::delUsuer($response['data']['idDelete'])) {
            echo json_encode(array(
                "result" => "sucesso",
                "data" => $result
            ));

        } else {

            echo json_encode(array(
                "result" => "erroInserir",                
                "messagem" => "Erro ao inserie no banco.",
            ));
        }
    }

    public function ValidacaoCampos($postArray){       

        foreach ($postArray as $key => $value){
            switch ($key) {
                case 'name':
                    // evitar injeção de sql   
                    $postArray[$key] = preg_replace('/[^[:alpha:]_]/', '',$value);
                    if (empty($postArray[$key]) || $postArray[$key] == null || $postArray[$key] == "") {
                        return array(
                            "result" => "erro",
                            "campo" => "Nome",
                            "messagem" => "O campo esta vazio!",
                        );
                    }
                    break;
                case 'sobrenome':
                    // evitar injeção de sql   
                    $postArray[$key] = preg_replace('/[^[:alpha:]_]/', '',$value);
                    if (empty($postArray[$key]) || $postArray[$key]== null || $postArray[$key] == "") {
                        return array(
                            "result" => "erro",
                            "campo" => "SobreNome",
                            "messagem" => "O campo esta vazio!",
                        );
                    }
                    break;
                case 'cpf':
                    // Extrai somente os números
                    $postArray[$key] = preg_replace( '/[^0-9]/is', '', $value );
                    // evitar injeção de sql                  
                    $postArray[$key] = preg_replace('/[^[:alnum:]_]/', '',$postArray[$key]);                    
         
                    if (empty($postArray[$key]) || $postArray[$key] == null || $postArray[$key] == "") {
                        return array(
                            "result" => "erro",
                            "campo" => "CPF",
                            "messagem" => "O campo esta vazio!",
                        );
                    }elseif ( $this->validaCPF($postArray[$key])) { 
                        return array(
                            "result" => "erroInserir",
                            "campo" => "CPF",
                            "messagem" => "Não foi possivel inserir dados!",
                        );
                    }
                    break;
            }
        } 
        
        return array(
            "result" => "sucesso",
            "data" => $postArray
        );
    }

    function validaCPF($cpf) {
          
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return true;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return true;
        }       
    
        // Faz o calculo para validar o CPF caso fosse para produção
        /*
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return true;
            }
        }*/
        return false;
    
    }

    public function ValidacaoDelete($postArray){

        if( array_key_exists('idDelete', $postArray ) ) {
            // chave existe
           if(!empty($postArray['idDelete'])){
            $postArray['idDelete'] = preg_replace( '/[^0-9]/is', '', $postArray['idDelete'] );
            $postArray['idDelete'] = preg_replace('/[^[:alnum:]_]/', '',$postArray['idDelete']);
            
            return array(
                "result" => "sucesso",
                "data" => $postArray
               ,
            );
           }
        }  else{
            
            return array(
                "result" => "erro",
                "campo" => "CPF",
                "messagem" => "Não existe ID",
            );

        }        
        
    }
}