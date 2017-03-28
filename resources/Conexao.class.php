<?php

require_once "DBConfig.class.php";

class Conexao
{
    private static $conexao;
    const CONN_STRING = "mysql:host=" . DBConfig::HOST . ";port=" . DBConfig::PORT . ";dbname=" . DBConfig::DATABASE_NAME . ";charset=UTF8;";

    private static function openConnection()
    {
        try {
            self::$conexao = new PDO(self::CONN_STRING, DBConfig::USERNAME, DBConfig::PASSWORD);
        } catch (PDOException $e) {
            echo "<script>console.error('" . addslashes($e->getMessage()) . "')</script>";
            die("Não foi possível conectar-se ao servidor.");
        }

        return self::$conexao;
    }

    public static function getInstance(): PDO
    {
        if (self::$conexao === NULL)
            self::openConnection();

        return self::$conexao;
    }
}