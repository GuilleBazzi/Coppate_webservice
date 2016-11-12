<?php

/**
 * Representa el la estructura de las eventos
 * almacenadas en la base de datos
 */
require 'Database.php';

class Usuario
{
    function __construct()
    {
    }

    /**
     * Retorna todos los registros de la tabla 'usuario'
     *
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM usuario";
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
     * Obtiene los campos de una usuario con un identificador
     * determinado
     *
     * @param $id_usuario Identificador del usuario
     * @return mixed
     */
    public static function getById($id_usuario)
    {
        // Consulta de el usuario
        $consulta = "SELECT * FROM usuario
                             WHERE id_usuario = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_usuario));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	
    public static function update(
        $id_usuario,
        $nombre,
        $apellido,
        $email,
        $fecha_nacimiento,
        $id_sexo,
		$alias,
		$foto
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE usuario" .
            " SET nombre=?, apellido=?, email=?, fecha_nacimiento=?, id_sexo=?, alias=?, foto=?" .
            "WHERE id_usuario=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $apellido, $email, $fecha_nacimiento, $id_sexo, $alias, $foto, $id_usuario));

        return $cmd;
    }

    /**
     * Insertar un nuevo usuario
     *
     * @return PDOStatement
     */
    public static function insert(
        $id_usuario,
        $nombre,
        $apellido,
        $email,
        $fecha_nacimiento,
        $id_sexo,
		$alias,
		$foto
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO usuario ( " .
            "id_usuario," .
            " nombre," .
            " apellido," .
            " email," .
            " fecha_nacimiento," .
            " id_sexo," .
            " alias," .
            " foto)" .
            " VALUES(?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
				$id_usuario,
				$nombre,
				$apellido,
				$email,
				$fecha_nacimiento,
				$id_sexo,
				$alias,
				$foto
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_usuario identificador de el usuario
     * @return bool Respuesta de la eliminación
     */
    public static function delete($id_usuario)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM usuario WHERE id_usuario=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_usuario));
    }
}

?>