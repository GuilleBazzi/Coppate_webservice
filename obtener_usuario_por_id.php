<?php
/**
 * Obtiene el detalle de una usuario especificada por
 * su identificador "id_usuario"
 */

require 'Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id_usuario'])) {

        // Obtener parámetro id_usuario
        $parametro = $_GET['id_usuario'];

        // Tratar retorno
        $retorno = Usuario::getById($parametro);

        if ($retorno) {

            $usuario["estado"] = "1";
            $usuario["usuario"] = $retorno;
            // Enviar objeto json de la usuario
            print json_encode($usuario);
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

