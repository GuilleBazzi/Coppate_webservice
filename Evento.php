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
     * Obtiene los campos de una evento con un identificador
     * determinado
     *
     * @param $id_evento Identificador del evento
     * @return mixed
     */
    public static function getById($id_evento)
    {
        // Consulta de el evento
        $consulta = "SELECT * FROM evento
                             WHERE id_evento = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_evento));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function getByIdOwner($id_owner)
    {
        // Consulta de el evento
        $consulta = "SELECT * FROM evento
                             WHERE id_owner = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_owner));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
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
     * el id_owner no se actualiza, ya que no cambia nunca.
     */
	 
    public static function update(
        $id_evento,
        $nombre,
        $edad_min,
        $edad_max,
        $cupo_min,
        $cupo_max,
		$costo,
        $fecha_inicio,
        $fecha_fin,
        $time_stamp,
        $foto,
        $ubicacion,
        $latitud,
        $longitud,
        $id_categoria,
        $desc_evento,
        $id_sexo,
		$estado
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE evento" .
            " SET nombre=?, edad_min=?, edad_max=?, cupo_min=?, cupo_max=?, costo=?, fecha_inicio=?, fecha_fin=?, time_stamp=NULL, foto=?, ubicacion=?, latitud=?, longitud=?, id_categoria=?, desc_evento=?, id_sexo=?, estado=? " .
            "WHERE id_evento=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $edad_min, $edad_max, $cupo_min, $cupo_max, $costo, $fecha_inicio, $fecha_fin, $time_stamp, $foto, $ubicacion, $latitud, $longitud, $id_categoria, $desc_evento, $id_sexo, $estado, $id_evento));

        return $cmd;
    }

    /**
     * Insertar una nueva evento
     *
     * @return PDOStatement
     */
    public static function insert(
		$nombre,
		$id_owner,
        $edad_min,
        $edad_max,
        $cupo_min,
        $cupo_max,
		$costo,
        $fecha_inicio,
        $fecha_fin,
        $time_stamp,
        $foto,
        $ubicacion,
        $latitud,
        $longitud,
        $id_categoria,
        $desc_evento,
        $id_sexo,
		$estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO evento ( " .
            "id_evento," .
            " nombre," .
            " id_owner," .
            " edad_min," .
            " edad_max," .
            " cupo_min," .
            " cupo_max," .
            " costo," .
            " fecha_inicio," .
            " fecha_fin," .
            " time_stamp," .
            " foto," .
            " ubicacion," .
            " latitud," .
            " longitud," .
            " id_categoria," .
            " desc_evento," .
            " id_sexo," .
            " estado)" .
            " VALUES(NULL,?,?,?,?,?,?,?,?,?,NULL,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
				$nombre,
				$id_owner,
				$edad_min,
				$edad_max,
				$cupo_min,
				$cupo_max,
				$costo,
				$fecha_inicio,
				$fecha_fin,
				$time_stamp,
				$foto,
				$ubicacion,
				$latitud,
				$longitud,
				$id_categoria,
				$desc_evento,
				$id_sexo,
				$estado
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