<?php
/**
 * Representa el la estructura de las peliculas
 * almacenadas en la base de datos
 */
require 'Database.php';
class Pelicula
{
    function __construct()
    {
    }
    /**
     * Retorna en la fila especificada de la tabla 'Pelicula'
     *
     * @param $idAlumno Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM Pelicula";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Obtiene los campos de una Pelicula con un identificador
     * determinado
     *
     * @param $id Identificador de la Pelicula
     * @return mixed
     */
    public static function getById($id)
    {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT id,
                            nombre,
                            descripcion,
                            categoria,
                            video_url,
                            imagen
                             FROM Pelicula
                             WHERE id = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $id        identificador
     * @param $nombre       nuevo nombre
     * @param $descripcion   nueva direccion
     * @param $categoria        nueva categoria
     * @param $video_url         nuevo video_url
     * @param $imagen       nueva imagen
	 
*/
    public static function update(
        $id,
        $nombre,
        $descripcion,
        $categoria,
        $video_url,
        $imagen
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE Pelicula" .
            " SET nombre=?, descripcion=?, categoria=?, video_url=?, imagen=? " . 
			"WHERE id=?";
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);
        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $descripcion, $categoria, $video_url, $imagen, $id));
        return $cmd;
    }
    /**
     * Insertar una nueva Pelicula
     *@param $id
     * @param $nombre      nombre del nuevo registro
     * @param $descripcion descripcion del nuevo registro
     *@param $categoria        nueva categoria
     * @param $video_url         nuevo video_url
     * @param $imagen
     * @return PDOStatement
     */
    public static function insert(
        $id,
        $nombre,
        $descripcion,
        $categoria,
        $video_url,
        $imagen
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO Pelicula ( id, "." nombre,"." descripcion,"."categoria,"." video_url,"." imagen)"." VALUES( ?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $id,
                $nombre,
                $descripcion,
                $categoria,
                $video_url,
                $imagen
            )
        );
    }
	
    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id identificador de la tabla Pelicula
     * @return bool Respuesta de la eliminación
     */
    public static function delete($id)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM Pelicula WHERE id=?";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($id));
    }
}
?>