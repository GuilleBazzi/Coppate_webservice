<?php
/**
 * Obtiene el detalle de una evento especificada por
 * su identificador "idOwner"
 */

require 'Evento.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idOwner'])) {

        // Obtener parámetro idOwner
        $parametro = $_GET['idOwner'];

        // Tratar retorno
        $retorno = Evento::getByIdOwner($parametro);


        if ($retorno) {

            $evento["estado"] = "1";
            $evento["eventos"] = $retorno;
            // Enviar objeto json de la evento
            print json_encode($evento);
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

