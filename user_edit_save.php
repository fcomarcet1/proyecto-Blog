<?php

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {

	include_once 'includes/lib/redirecc_user_nologin.php';
	include_once 'includes/lib/mysql.php';
	include_once 'includes/conexion.php';
	include_once 'includes/header.php';
	include_once 'includes/aside.php';

	//Validamos que se reciben los campos del form
	if (isset($_POST['nombre']) && isset($_POST['apellidos']) &&
			isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_repeat'])) {

		//VARIABLES
		$errores = array();
		$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, trim($_POST['nombre'])) : false;
		$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conexion, trim($_POST['apellidos'])) : false;
		$email = isset($_POST['email']) ? mysqli_real_escape_string($conexion, trim($_POST['email'])) : false;
		$password = isset($_POST['password']) ? mysqli_real_escape_string($conexion, trim($_POST['password'])) : false;
		$password_repeat = isset($_POST['password_repeat']) ? mysqli_real_escape_string($conexion, trim($_POST['password_repeat'])) : false;
		$id_user = $_SESSION['usuario']['idusuario'];

		/*
		  echo $nombre ."<br/>";
		  echo $apellidos ."<br/>";
		  echo $email."<br/>";
		  echo $password ."<br/>";
		  echo $password_repeat ."<br/>";
		  echo $id_user ."<br/>";
		  die();
		 */

		//var_dump($_POST);
		//Validacion de campos
		//validacion de que algun campo esta vacio
		$update_validate_user = false;
		if (empty($nombre) || empty($apellidos) || empty($email) ||
				empty($password) || empty($password_repeat)) {

			$update_validate_user = false;
			$errores['campo_vacio'] = "Alguno de los campos esta vacio.Por favor rellena todo los campos";
		}
		//NOMBRE
		if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
			$nombre_validate = true;
		} else {
			$nombre_validate = false;
			$errores['nombre'] = "El nombre no es válido";
		}

		if (empty($nombre)) {
			$update_validate_user = false;
			$errores['nombre'] = "Campo nombre vacio";
		}
		//APELLIDOS
		if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {

			$nombre_validate = true;
		} else {
			$nombre_validate = false;
			$errores['apellidos'] = "Los apellidos no son válidos";
		}

		if (empty($apellidos)) {
			$update_validate_user = false;
			$errores['apellidos'] = "Campo apellidos vacio";
		}

		//EMAIL
		if (empty($email)) {

			$email_validate = false;
			$errores['email'] = "Campo email vacio";
		}

		if ((!empty($email)) && (filter_var($email, FILTER_VALIDATE_EMAIL))) {

			$email_validate = true;
			//echo 'email OK'. '<br/>';
		} else {

			echo 'email ERROR,';
			$email_validate = false;
			$errores['email'] = "Introduce un email valido por favor.";
			//echo 'email con formato incorrectos ERROR,'. '<br/>';
			//var_dump($errores);
		}

		//PASSWORD
		if (empty($password)) {

			$password_validate = false;
			$errores['password'] = "El  primer campo contraseña esta vacio";
			//echo 'passwd vacio ERROR'. '<br/>';
		} elseif (strlen($password) < 4) {

			$password_validate = false;
			$errores['password'] = "La contraseña debe contener como minimo 4 caracteres";
			//echo 'passwd vacio ERROR'. '<br/>';
		} else {
			$password_validate = true;
			//echo 'passwd OK'. '<br/>';
		}

		if (empty($password_repeat)) {
			$update_validate_user = false;
			$errores['password_repeat'] = " El segundo campo password vacio";
		} elseif (strlen($password) < 4) {

			$password_validate = false;
			$errores['password_repeat'] = "La contraseña debe contener como minimo 4 caracteres";
			//echo 'passwd vacio ERROR'. '<br/>';
		} else {
			$password_validate = true;
			//echo 'passwd OK'. '<br/>';
		}


		//VALIDACION ERRORES
		$count_errors = sizeof($errores);
		$user_update = false;

		if ($count_errors == 0) {
			//validamos que las 2 contraseñas son iguales
			if ($password == $password_repeat) {

				//encriptado de passwords
				$password_secure = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

				//validacion email es unico
				$select = "SELECT idusuario,email FROM usuarios WHERE email= '$email' ";
				$result = mysqli_query($conexion, $select);
				$email_user = mysqli_fetch_assoc($result);

				if (($email_user['idusuario'] == $_SESSION['usuario']['idusuario']) || empty($email_user)) {
					//UPDATE
					$sql_update_user = "UPDATE usuarios "
							. "SET nombre = '$nombre', apellidos = '$apellidos', "
							. "email = '$email', password = '$password_secure'"
							. "WHERE idusuario = $id_user  ";

					$user_update = mysqli_query($conexion, $sql_update_user);
					//var_dump(mysqli_error($conexion));

					if ($user_update) {
						//UPDATE OK
						$user_update = true;
						$_SESSION['update_user_ok'] = "Tus datos se actualizaron correctamente.";

						//modificamos los datos de la variable de session del usuario para no reloguear y ver los cambios
						$sql = "SELECT * FROM usuarios WHERE idusuario = $id_user";
						$query = mysqli_query($conexion, $sql);

						if ($query) {

							$usuario = mysqli_fetch_assoc($query);
							$_SESSION['usuario'] = $usuario;
						} else {
							//error query
							$_SESSION['error_usuario'] = "Error al modificar los datos de usuario de la sesion";
							$_SESSION['error_usuario_show'] = "Por favor reloguea para ver tus nuevos datos correctamente";
						}

						//liberamos de la memoria del server la consulta
						cleanMemory($query);

						//redireccion a index.php
						//header('Location: user_edit.php');
					} else {
						//UPDATE ERROR
						$user_update = false;
						$_SESSION['update_user_error'] = "Error al actualizar tus datos";
						//header('Location: user_edit.php');
					}
				} else {
					//error email ya existe
					$_SESSION['email_exist'] = "Este email ya existe, por favor introduce otro email";
				}
			} else {
				$_SESSION['password_not_same'] = "Las contraseñas no coinciden";
				//header('Location: user_edit.php');
				//var_dump($_SESSION);
			}
		} else {
			//EXISTEN ERRORES EN EL FORM
			$user_update = false;
			$_SESSION['errores'] = $errores;
			//header('Location: user_edit.php');
		}
		//TESTEAR METER SOLO UN HEADER A USER_EDIT.PHP		
	}//issets
	//
//cerramos conexion con la BD	
	disconnectDB($conexion);
	header('Location: user_edit.php');
}// FIN $_SERVER['REQUEST_METHOD']
?>
