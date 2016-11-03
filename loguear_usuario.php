<?php
/**
 * Insertar un nuevo usuario en la base de datos
 */

require 'Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
	
    $existeUsuario = Usuario::getById($body['id_usuario']);
	
	if (!$existeUsuario) {

		// Insertar usuario
		$retorno = Usuario::insert(
			$body['id_usuario'],
			$body['nombre'],
			$body['apellido'],
			$body['email'],
			$body['fecha_nacimiento'],
			$body['id_sexo'],
			$body['alias'],
			$body['foto']);

		if ($retorno) {
			// C�digo de �xito
			print json_encode(
				array(
					'estado' => '1',
					'mensaje' => 'Creaci�n �xitosa')
			);
		} else {
			// C�digo de falla
			print json_encode(
				array(
					'estado' => '2',
					'mensaje' => 'Creaci�n fallida')
			);
		}		
	} else {		
		// Actualizar usuario
		$retorno = Usuario::update(
			$body['id_usuario'],
			$body['nombre'],
			$body['apellido'],
			$body['email'],
			$body['fecha_nacimiento'],
			$body['id_sexo'],
			$body['alias'],
			$body['foto']);

		if ($retorno) {
			// C�digo de �xito
			print json_encode(
				array(
					'estado' => '1',
					'mensaje' => 'Actualizaci�n �xitosa')
			);
		} else {
			// C�digo de falla
			print json_encode(
				array(
					'estado' => '2',
					'mensaje' => 'Actualizaci�n fallida')
			);
		}
	}
}
