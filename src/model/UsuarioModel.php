<?php

namespace Source\model;

use Source\utils\ConexaoBD;

abstract class UsuarioModel{

    public static function getUsuers(){
        $database = ConexaoBD::connectDB();

        $query = 'SELECT id, nome, sobrenome, cpf From usuarios';
        $result = $database->query($query);
        $dados = array();

        if($result->num_rows > 0){
            while($value = $result->fetch_assoc()){
                $dados[] = $value;
            }
        }

        return $dados;
    }
    public static function addUsuer($data){
        $database = ConexaoBD::connectDB();      
        $query =  "INSERT INTO usuarios (nome, sobrenome, cpf, editavel) VALUES (?, ?, ?, 1)";
        $stmt = $database->prepare($query);     
        $stmt->bind_param("sss", $data['name'], $data['sobrenome'], $data['cpf']);
        $result = $stmt->execute();        
        return $result;
    }
    public static function delUsuer($data){
        $database = ConexaoBD::connectDB();       
       
        $query  = "DELETE FROM usuarios WHERE id= ?";
        $stmt = $database->prepare($query);        
        $stmt->bind_param("s", $data);
        $stmt->execute();
        $result = $stmt->get_result();        
        return $result;
    }

    public static function buscaPorIdUsuer($data){
        $database = ConexaoBD::connectDB();
       
        $query = 'SELECT id, nome, sobrenome, cpf From usuarios where id = ?';
        $stmt = $database->prepare($query);        
        $stmt->bind_param("s", $data);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public static function editUsuer($data){
        $database = ConexaoBD::connectDB();

        if ($data['campo'] == 'name') {

            $campo = 'nome';
        }else{

            $campo = $data['campo'];
        }

        $query = 'UPDATE usuarios SET '.$campo.' = ? WHERE id = ?';  
        $stmt = $database->prepare($query);            
        $stmt->bind_param("ss",  $data['valor'], $data['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }   
}