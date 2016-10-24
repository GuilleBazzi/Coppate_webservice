<?php
/**
 * Obtiene todas las eventos de la base de datos
 */

require 'Evento.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $eventos = Evento::getAll();

    if ($eventos) {

        $datos["estado"] = 1;
        $datos["eventos"] = $eventos;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}