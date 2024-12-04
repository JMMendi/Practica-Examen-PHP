<?php

namespace App\Utils;

class Datos {
    public static function getCategorias() : array {
        return ['Arte', 'Política', 'Medio Ambiente', 'Historia', 'Ciencia', 'Ficción'];
    }

    public static function getStatus() : array {
        return ['PUBLICADO', 'BORRADOR'];
    }
}