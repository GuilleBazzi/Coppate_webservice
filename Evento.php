<?php

/**
 * Representa el la estructura de las eventos
 * almacenadas en la base de datos
 */
require 'Database.php';

class Evento
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'evento'
     *
     * @param $id_evento Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM evento";
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
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     */
	 
    public static function update(
        $id_evento,
        $edad_min,
        $edad_max,
        $cupo_min,
        $cupo_max,
        $fecha,
        $foto,
        $ubicacion,
        $latitud,
        $longitud,
        $id_categoria,
        $desc_evento,
        $id_sexo
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE evento" .
            " SET edad_min=?, edad_max=?, cupo_min=?, cupo_max=?, fecha=?, foto=?, ubicacion=?, latitud=?, longitud=?, id_categoria=?, desc_evento=?, id_sexo=? " .
            "WHERE id_evento=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($edad_min, $edad_max, $cupo_min, $cupo_max, $fecha, $foto, $ubicacion, $latitud, $longitud, $id_categoria, $desc_evento, $id_sexo, $id_evento));

        return $cmd;
    }

    /**
     * Insertar una nueva evento
     *
     * @return PDOStatement
     */
    public static function insert(
		$id_owner,
        $edad_min,
        $edad_max,
        $cupo_min,
        $cupo_max,
        $fecha,
        $foto,
        $ubicacion,
        $latitud,
        $longitud,
        $id_categoria,
        $desc_evento,
        $id_sexo
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO evento ( " .
            "id_evento," .
            "id_owner," .
            " edad_min," .
            " edad_max," .
            " cupo_min," .
            " cupo_max," .
            " fecha," .
            " foto," .
            " ubicacion," .
            " latitud," .
            " longitud," .
            " id_categoria," .
            " desc_evento," .
            " id_sexo)" .
            " VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
				$id_owner,
				$edad_min,
				$edad_max,
				$cupo_min,
				$cupo_max,
				$fecha,
				$foto,
				$ubicacion,
				$latitud,
				$longitud,
				$id_categoria,
				$desc_evento,
				$id_sexo
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_evento identificador de el evento
     * @return bool Respuesta de la eliminación
     */
    public static function delete($id_evento)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM evento WHERE id_evento=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_evento));
    }
}

?>