<?php

namespace App\Db;

use \PDO;

require __DIR__."/../../vendor/autoload.php";

class Conexion {
    private static ?PDO $conexion = null;
    
    protected static function getConexion() : ?PDO {
        if (self::$conexion === null) {
            self::setConexion();
        }
        return self::$conexion;
    }

    private static function setConexion() : void {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__."/../../");
        $dotenv->load();

        $usuario = $_ENV['USUARIO'];
        $password = $_ENV['PASSWORD'];
        $database = $_ENV['DATABASE'];
        $port = $_ENV['PORT'];
        $host = $_ENV['HOST'];

        $dsn = "mysql:dbname=$database; port=$port; host=$host; charset=UTF8mb4;";

        $options = [
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT=>true
        ];

        self::$conexion = new PDO ($dsn, $usuario, $password, $options);
    }

    protected static function cerrarConexion() : void {
        self::$conexion = null;
    }
}