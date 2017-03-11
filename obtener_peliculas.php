<?php
/**
 * Obtiene todas las peliculas de la base de datos
 */
require 'Pelicula.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $pelicula = Pelicula::getAll();
    if ($pelicula) {
        $datos["estado"] = 1;
        $datos["pelicula"] = $pelicula;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}
?>