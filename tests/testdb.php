<?php
require_once 'includes/conexion.php';
require_once 'includes/lib/mysql.php';
require_once 'includes/lib/helpers.php'; 

/*
//Generamos la consulta
$sql_select = "SELECT * FROM usuarios";
$result = mysqli_query($conexion, $sql_select);

while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	
	echo "Id :". $row['idusuario']."<br/>";
	echo "Nombre :". $row['nombre']."<br/>";
	
}

*/
	
$errores_categorias = array();
$errores_categorias['error_name_category_add'] = "Campo vacio, por favor inserte una categoria.";
$errores_categorias['error_name_category_add'] = "Nombre de categoria no valido.Solo puede contener May/min o nums";

$_SESSION['category_add_ok'] = "Categoria añadida correctamente";
$_SESSION['category_add_error'] = "Error al añadir la nueva categoria.";

//tipo error
$_SESSION['errors_category_add'] = $errores_categorias;
	

var_dump($_SESSION);

//desconectamos la base de datos
//disconnectDB($conexion);


?>

