<?php
/**
 * Insertar una nueva evento en la base de datos
 */

require 'Evento.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
	
	
    // Insertar evento
    $retorno = Evento::insert(
        $body['nombre'],
        $body['id_owner'],
        $body['edad_min'],
        $body['edad_max'],
        $body['cupo_min'],
        $body['cupo_max'],
        $body['costo'],
        $body['fecha_inicio'],
        $body['fecha_fin'],
        $body['time_stamp'],
        $body['foto'],
        $body['ubicacion'],
        $body['latitud'],
        $body['longitud'],
        $body['id_categoria'],
        $body['desc_evento'],
        $body['id_sexo'],
        $body['estado']);

    if ($retorno) {
		// Código de éxito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Creación éxitosa')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Creación fallida')
        );
    }
}
// print "Se ejecutó todo el código PHP";