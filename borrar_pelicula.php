<?php
/**
 * Elimina una pelicula de la base de datos
 * distinguida por su identificador
 */
require 'Pelicula.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    $retorno = Pelicula::delete($body['id']);
	
	//$json_string = json_encode($clientes);
	//echo 'antes de entrar';
	
    if ($retorno) {
		
        $json_string = json_encode(
		array(
		"estado" => 1,"mensaje" => "Eliminacion exitosa"));
		
		echo $json_string;
		
    } else {
		
        $json_string = json_encode(
		array("estado" => 2,"mensaje" => "No se elimino el registro"));
		
		echo $json_string;
    }
}
?>