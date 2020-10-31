<?php
 include_once './includes/conexion.php';
 include_once './includes/lib/validaciones.php';


//var_dump($_POST);

if ( ($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['submit'])) ) {
	
	
	//array errores
	$errores = array();

	if (isset($_POST['nombre']) && isset($_POST['apellidos']) && 
		isset($_POST['email']) && isset($_POST['contraseña'])) {

		$nombre = validate($_POST['nombre']);
		$apellidos = validate($_POST['apellidos']);
		$email = validate($_POST['email']);
		$password = validate($_POST['password']);
		
		
		//VALIDAR NOMBRE
		//¿SEPARAR IF PARA ANALIZAR CADA ERROR EN DETALLE?
		$pattern = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ]+$/";
		if ((!empty($nombre)) && (is_string($nombre)) && (preg_match($pattern, $nombre))) {
			
				//NO ERROR
			
		}
		else{
			
			//$error = "El nombre solo puede contener letras.";
			$errores['nombre'] = "El nombre solo puede contener letras.";		
			
		}
		
		
		
		//VALIDAR APELLIDOS
		
		//VALIDAR EMAIL
		
		//VALIDAR CONTRASEÑA

	}//final isset


	
}//final request_method 




?>
