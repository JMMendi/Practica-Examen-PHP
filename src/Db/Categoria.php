<?php

namespace App\Db;

use App\Utils\Datos;
use \PDO;
use \PDOException;

require __DIR__."/../../vendor/autoload.php";

class Categoria extends Conexion {
    private int $id;
    private string $nombre;

    public static function executeQuery(string $q, array $option = [], bool $devolverAlgo = false, string $error) {
        $stmt = parent::getConexion()->prepare($q);

        try {
            $stmt->execute($option);
        } catch (PDOException $ex) {
            throw new PDOException("Error en el ".$error. " :". $ex->getMessage(), -1);
        } finally {
            parent::cerrarConexion();
        }

        if ($devolverAlgo) {
            return $stmt;
        }
    }

    public function create() : void {
        $q = "insert into categorias (nombre) values (:u)";

        self::executeQuery($q, [':u' => $this->nombre], false, "create (Categoria)");
    }


    // -----------------------------------

    public static function devolverIdsCategorias() : array {
        $q = "select id from categorias order by nombre";

        $stmt = self::executeQuery($q, [], true, "devolverIdsCategorias");

        $ids = [];
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)){
            $ids[] = $fila->id;
        } 

        return $ids;
    }

    public static function crearCategoriasRandom() : void {
        foreach (Datos::getCategorias() as $categoria) {
            $nombre = $categoria;

            (new Categoria)
            ->setNombre($nombre)
            ->create();
        }
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
}