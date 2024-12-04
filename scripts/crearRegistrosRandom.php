<?php

use App\Db\Categoria;
use App\Db\Post;

require __DIR__."/../vendor/autoload.php";

$cantidad = 0;

do {
    $cantidad = readline("Introduce el número de registros: ");
    if ($cantidad < 10 || $cantidad > 30) {
        echo "Error, introduce entre 10 y 30";
    }
} while ($cantidad < 10 || $cantidad > 30);

if (count(Categoria::devolverIdsCategorias()) == 0) {
    Categoria::crearCategoriasRandom();
}

Post::crearPostsRandom($cantidad);

echo "Se han creado $cantidad posts".PHP_EOL;