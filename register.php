<?php

if ( ($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['submit'])) ) {
	
	//conviene hacer los includes aqui dentro
	include_once './includes/conexion.php';
	include_once './includes/lib/validaciones.php';
	include_once './includes/lib/mysql.php';

	//var_dump($_POST);
	
	if (!isset($_SESSION)) {
		
		session_start();
	}

	/*
	  Vamos a usar el operador ternario
	  Ej
	  $a = isset($_POST['passwd']) ? $_POST['passwd'] :false
	  Si se cumple la 1º condicion( isset($_POST['passwd']) ), tomara el valor $_POST['passwd']
	  sino valdra false.
	 */
	
	//$nombre = validate($_POST['nombre']);
	//$apellidos = validate($_POST['apellidos']);
	
	//recogemos valores del formulario
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, trim($_POST['nombre'])) : false;
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conexion, ($_POST['apellidos'])) : false;
	$email = isset($_POST['email']) ? mysqli_real_escape_string($conexion, trim($_POST['email'])) : false;
	$password = isset($_POST['password']) ? mysqli_real_escape_string($conexion, trim($_POST['password'])) : false;

	
	//ARRAY ERRORES
	$errores = array();


	//VALIDACION DATOS
	// $pattern = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ]+$/";
	// elseif ((!empty($nombre)) && (is_string($nombre)) && (preg_match($pattern, $nombre))) {
	
	//NOMBRE
	if (empty($nombre)) {
		$nombre_validate = false;
		$errores['nombre'] = "El campo nombre no puede estar vacio.";
		//echo 'nombre vacio ERROR,';
		//var_dump($errores);
	}
	elseif ((!empty($nombre)) && (!is_numeric($nombre)) && (!preg_match("/[0-9]/", $nombre))) {
		$nombre_validate = true;
	} 
	else {
		$nombre_validate = false;
		$errores['nombre'] = "El campo nombre no es valido.";
		//echo 'nombre con caracteres incorrectos ERROR,'. '<br/>';
		//var_dump($errores);
	}
	

	//APELLIDOS
	if (empty($apellidos)) {

		$apellidos_validate = false;
		$errores['apellidos'] = "El campo apellidos no puede estar vacio.";
		//echo 'apellidos vacio ERROR,';
		//var_dump($errores);
	}
	 elseif ((!empty($apellidos)) && (!is_numeric($apellidos)) && (!preg_match("/[0-9]/", $apellidos))) {

		$apellidos_validate = true;
		//echo 'apellidos ok,'. '<br/>';
	} 
	else {

		$apellidos_validate = false;
		$errores['apellidos'] = "El campo apellidos no es valido.";
		//echo 'apellidos con caracteres incorrectos ERROR,'. '<br/>';
		//var_dump($errores);
	}


	//EMAIL
	if (empty($email)) {

		$email_validate = false;
		$errores['email'] = "El campo email vacio";
		//echo 'email vacio ERROR,'. '<br/>';
	} 
	
	if ((!empty($email)) && (filter_var($email, FILTER_VALIDATE_EMAIL))) {

		$email_validate = true;
		//echo 'email OK'. '<br/>';
	} 
	else {

		echo 'email ERROR,';
		$email_validate = false;
		$errores['email'] = "Introduce un email valido por favor.";
		//echo 'email con formato incorrectos ERROR,'. '<br/>';
		//var_dump($errores);
	}

	//PASSWORD
	if (empty($password)) {

		$password_validate = false;
		$errores['password'] = "El campo contraseña esta vacio";
		//echo 'passwd vacio ERROR'. '<br/>';
	} 
	elseif (strlen($password) < 4) {

		$password_validate = false;
		$errores['password'] = "La contraseña debe contener como minimo 4 caracteres";
		//echo 'passwd vacio ERROR'. '<br/>';
	} 
	else {
		$password_validate = true;
		//echo 'passwd OK'. '<br/>';
	}


	//VALIDACION ERRORES
	$save_user = false;
	if (count($errores) == 0) {

		//echo 'No exixten errores => INSERT';
		$save_user = true;

		//CIFRADO PASSWORD
		$password_secure = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

		//DEBUGG
		//var_dump($password);
		//var_dump($password_secure);
		//var_dump(password_verify($password, $password_secure));

		$sql_insert = "INSERT INTO usuarios (nombre, apellidos, email, password)
					   VALUES ('$nombre', '$apellidos', '$email', '$password_secure') ";

		$resultado = mysqli_query($conexion, $sql_insert);
		
		//DEBUGG PARA VER ERROR EN EL INSERT
		//var_dump(mysqli_error($conexion));
		//die();

		
		//CREACION DE SESIONES
		if ($resultado) {

			$_SESSION['register_ok'] = "Registo completado con exito.";
		} 
		else {
			$_SESSION['errores']['registro'] = "Error en el registro de usuarios";
		}

	} 
	else {//si existen errores creamos la variable de sesion con los valores del array de errores
		
		$_SESSION['errores'] = $errores;
		header('Location: index.php');
	}

	//cerramos la conexion
	//disconnectDB($conexion);

	//redirecc al index.php
	header('Location: index.php');

	//var_dump($errores);
}
