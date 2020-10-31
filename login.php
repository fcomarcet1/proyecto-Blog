<?php

/* 
    PASOS
        1-recoger datos del form
        2-validar email y contraseña.
        3-consulta a la BDpara comprobar credenciales del usuario
        4-ustilizar session para guardar datos del usuario logueado
        5-si algo falla crear sesion con el fallo
        6-redirigir al index.php
*/

//iniciar sesion y cenexion a la BD
include_once './includes/conexion.php';
include_once './includes/lib/validaciones.php';
include_once './includes/lib/mysql.php';

if (!isset($_SESSION)) {

    session_start();
}

// recoger datos del form
if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['submit_register']))) {
	if (isset($_POST['email']) && (isset($_POST['password'])) ) {

		// borramos el error antiguo de array $_SESSION['error_login']
		if (isset($_SESSION['error_login'])) {
					
			unset($_SESSION['error_login']);	
		}
		
		//limpiamos espacios con trim y recogemos datos del form
		$email = trim($_POST['email']);
		$password = $_POST['password'];
		
		//consulta para comprobar credenciales
		$sql_select = "SELECT * FROM usuarios WHERE email = '$email'";
		$result = mysqli_query($conexion, $sql_select);
		
		if (($result == true) && (mysqli_num_rows($result) == 1) ) {
			
			//vamos a obtener los datos mediante un array asociativo
			$usuario = mysqli_fetch_assoc($result);
			
			//comprobar pass entre la obtenida de la consulta y la que nos llga del form
			$verify_passwd = password_verify($password, $usuario['password']);
			
			if ($verify_passwd) {
				
				//creamos la session con los datos del usuario logueado que obtenemos del array $usuario
				$_SESSION['usuario'] = $usuario;
			}
			
			else {
				$_SESSION['error_login'] = "Login incorrecto, contraseña incorrecta";
				//PASSWD incorrecto creamos sesion con los datos del error
			}
		}	
		else {
			//mensaje error no existe el email
			$_SESSION['error_login'] = "Login incorrecto, email incorrecto comprueba tu email o registrate";
		}		
	}//fin isset $post
	
}//fin request && isset

//Limpiamia de la memoria la query
//mysqli_free_result( $result);

//cerramos conexion
//disconnectDB($conexion);

// redireccion a index.php
header('Location: index.php');







?>