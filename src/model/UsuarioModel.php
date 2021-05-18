<?php

namespace Source\model;

use Source\utils\ConexaoBD;

abstract class UsuarioModel{

    public static function getUsuers(){
        $database = ConexaoBD::connectDB();

        $query = 'SELECT nome, sobrenome, cpf From usuarios';
        $result = $database->query($query);
        $dados = array();

        if($result->num_rows > 0){
            while($value = $result->fetch_assoc()){
                $dados[] = $value;
            }
        }

        return $dados;
    }
}