<?php

namespace Source\utils;

abstract class ConexaoBD{

    private static $conn;

    public static function connectDB(){
        if(self::$conn == null){
            self::$conn = new \mysqli("db", "root", "test", "cktdb");
        }

        if(self::$conn->connect_error){
            die("Connection failed" . self::$conn->connect_error);
        }
    
        return self::$conn;
    }
}