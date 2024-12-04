<?php

namespace App\Db;

use App\Utils\Datos;
use \PDOException;

require __DIR__."/../../vendor/autoload.php";

class Post extends Conexion {
    private int $id;
    private string $titulo;
    private string $contenido;
    private string $status;
    private int $categoria_id;

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
        $q = "insert into posts (titulo, contenido, status, categoria_id) values (:t, :c, :s, :cid)";

        self::executeQuery($q, [':t' => $this->titulo, ':c' =>$this->contenido, ':s' => $this->status, ':cid' => $this->categoria_id], false, "create (Post)");
    }


    // -------------------------------------------------

    public static function crearPostsRandom(int $cantidad) : void {
        $faker = \Faker\Factory::create("es_ES");

        for ($i = 0 ; $i < $cantidad ; $i++) {
            $titulo = $faker->sentence();
            $contenido = $faker->text(200);
            $status = $faker->randomElement(Datos::getStatus());
            $categoria_id = $faker->randomElement(Categoria::devolverIdsCategorias());

            (new Post)
            ->setTitulo($titulo)
            ->setContenido($contenido)
            ->setStatus($status)
            ->setCategoriaId($categoria_id)
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
     * Get the value of titulo
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of contenido
     */
    public function getContenido(): string
    {
        return $this->contenido;
    }

    /**
     * Set the value of contenido
     */
    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of categoria_id
     */
    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }

    /**
     * Set the value of categoria_id
     */
    public function setCategoriaId(int $categoria_id): self
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }
}