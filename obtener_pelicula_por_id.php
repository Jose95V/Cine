<?php
/**
 * Obtiene el detalle de una pelicula especifica por
 * su identificador "id"
 */
require 'Pelicula.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	
    if (isset($_GET['id'])) {
        // Obtener parámetro id de la pelicula
		
        $parametro = $_GET['id'];
		
        // Tratar retorno
		
        $retorno = Pelicula::getById($parametro);
		
        if ($retorno) {
			
            $pelicula["estado"] = 1;		// cambio "1" a 1 porque no toma bien la cadena.
            $pelicula["pelicula"] = $retorno;
			
            // Enviar objeto json de la pelicula
            print json_encode($pelicula);
			
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}
?>