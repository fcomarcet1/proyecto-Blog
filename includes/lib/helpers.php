<?php

##################################################################################
##################################################################################
#**************** Muestra ERRORES DEL ARRAY ERRORES DEL REGISTRO******************
// in: $errores=array errores,

function mostrarError($errores, $campo) {
	$alerta = "";

	if ((isset($errores[$campo])) && (!empty($campo))) {

		$alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
	}
	return $alerta;
}

##################################################################################
##################################################################################
#**************** ELIMINA ERRORES DEL LA VARIABLE DE SESION **********************

function borrarErrores() {
	$borrado = false;

	//LImpia errores del registro
	if (isset($_SESSION['errores'])) {

		$_SESSION['errores'] = null;
		unset($_SESSION['errores']);
	}

	if (isset($_SESSION['register_ok'])) {

		$_SESSION['register_ok'] = null;
		unset($_SESSION['register_ok']);
	}

	//limpia errores del login
	if (isset($_SESSION['error_login'])) {

		$_SESSION['error_login'] = null;
		unset($_SESSION['error_login']);
	}

	//limpia errores categorias
	if (isset($_SESSION['category_add_ok'])) {

		$_SESSION['category_add_ok'] = null;
		unset($_SESSION['category_add_ok']);
	}

	if (isset($_SESSION['error_name_category_add'])) {

		$_SESSION['error_name_category_add'] = null;
		unset($_SESSION['error_name_category_add']);
	}

	if (isset($_SESSION['errors_category_add']['error_name_category_add'])) {

		$_SESSION['errors_category_add']['error_name_category_add'] = null;
		unset($_SESSION['errors_category_add']['error_name_category_add']);
	}

	if (isset($_SESSION['category_add_error'])) {

		$_SESSION['category_add_error'] = null;
		unset($_SESSION['category_add_error']);
	}

	//limpia errores anadir entradas.
	if (isset($_SESSION['article_add_ok'])) {

		$_SESSION['article_add_ok'] = null;
		unset($_SESSION['article_add_ok']);
	}

	if (isset($_SESSION['article_add_error'])) {

		$_SESSION['article_add_error'] = null;
		unset($_SESSION['article_add_error']);
	}

	if (isset($_SESSION['errors_article_add'])) {

		$_SESSION['errors_article_add'] = null;
		unset($_SESSION['errors_article_add']);
	}

	if (isset($_SESSION['article_add_empty'])) {

		$_SESSION['article_add_empty'] = null;
		unset($_SESSION['article_add_empty']);
	}

	//limpia errores editar usuario
	if (isset($_SESSION['errores']['campo_vacio'])) {

		$_SESSION['errores']['campo_vacio'] = null;
		unset($_SESSION['errores']['campo_vacio']);
	}

	if (isset($_SESSION['errores']['password'])) {

		$_SESSION['errores']['password'] = null;
		unset($_SESSION['errores']['password']);
	}

	if (isset($_SESSION['errores']['password_repeat'])) {

		$_SESSION['errores']['password_repeat'] = null;
		unset($_SESSION['errores']['password_repeat']);
	}

	if (isset($_SESSION['update_user_error'])) {

		$_SESSION['update_user_error'] = null;
		unset($_SESSION['update_user_error']);
	}

	if (isset($_SESSION['password_not_same'])) {

		$_SESSION['password_not_same'] = null;
		unset($_SESSION['password_not_same']);
	}

	if (isset($_SESSION['update_user_ok'])) {

		$_SESSION['update_user_ok'] = null;
		unset($_SESSION['update_user_ok']);
	}

	//errores modificar sesion al modificar datos de usuario
	if (isset($_SESSION['error_usuario'])) {

		$_SESSION['error_usuario'] = null;
		unset($_SESSION['error_usuario']);
	}

	if (isset($_SESSION['error_usuario_show'])) {

		$_SESSION['error_usuario_show'] = null;
		unset($_SESSION['error_usuario_show']);
	}

	//limpiar errores eliminar entrada
	if (isset($_SESSION['delete_ok'])) {

		$_SESSION['delete_ok'] = null;
		unset($_SESSION['delete_ok']);
	}

	if (isset($_SESSION['delete_article_error'])) {

		$_SESSION['delete_article_error'] = null;
		unset($_SESSION['delete_article_error']);
	}

	//limpiar errores editar entrada


	if (isset($_SESSION['article_edit_ok'])) {

		$_SESSION['article_edit_ok'] = null;
		unset($_SESSION['article_edit_ok']);
	}

	if (isset($_SESSION['article_edit_error'])) {

		$_SESSION['article_edit_error'] = null;
		unset($_SESSION['article_edit_error']);
	}

	return $borrado;
}

##################################################################################
##################################################################################
#**************** MOSTRAR CATEGORIAS *********************************************

//db_conn nos la acabamos de inventar en la vista recibe $conexion
function mostrar_categorias($db_conn) {
	$slq_select = "SELECT * FROM categorias ORDER BY idcategoria ASC";

	//le pasamos una variable $db_conn
	$categorias = mysqli_query($db_conn, $slq_select);

	//creamos array para almacenar resultado de la query
	$result = array();

	if (($categorias) && (mysqli_num_rows($categorias) >= 1)) {

		// si existe la query le pasamos al array los datos de la consulta
		$result = $categorias;
	} else {
		$result = null;
	}


	return $result;
	$mysqli_free_result = mysqli_free_result($categorias);
}

##################################################################################
##################################################################################
#**************** MOSTRAR CATEGORIA  *********************************************
//muestra una categoria dado un id 

function mostrar_categoria($db_conn, $idcategoria) {

	$slq_select = "SELECT * FROM categorias WHERE idcategoria = $idcategoria ";

	//le pasamos una variable $db_conn
	$categorias = mysqli_query($db_conn, $slq_select);

	//creamos array para almacenar resultado de la query
	$result = array();

	if (($categorias) && (mysqli_num_rows($categorias) >= 1)) {

		// si existe la query le pasamos al array los datos de la consulta
		$result = mysqli_fetch_assoc($categorias);
	}

	return $result;

	//$mysqli_free_result = mysqli_free_result($categorias);
}

##################################################################################
##################################################################################
#**************** LISTAR ULTIMAS ENTRADAS *********************************************

//db_conn nos la acabamos de inventar en la vista recibe $conexion
function mostrar_ultimas_entradas($db_conn) {
	$slq_select = "SELECT e.*, c.* FROM entradas e\n" .
			"INNER JOIN categorias c\n" .
			"ON e.id_categoria = c.idcategoria\n" .
			"ORDER BY fecha_entrada DESC LIMIT 4 ";

	//le pasamos una variable $db_conn, que en la vista recibira $conexion(nuestra verdadera var de conexion)
	$ultimas_entradas = mysqli_query($db_conn, $slq_select);


	//creamos array para almacenar resultado de la query
	$result = array();

	if (($ultimas_entradas) && (mysqli_num_rows($ultimas_entradas) >= 1)) {

		// si existe la query le pasamos al array los datos de la consulta
		$result = $ultimas_entradas;
	} else {
		$result = null;
	}

	return $result;
	$mysqli_free_result0 = mysqli_free_result($ultimas_entradas);
}

##################################################################################
##################################################################################
#**************** LISTAR ENTRADAS PARAMETRIZADA *************************

// es similar a mostrar_ultimas_entradas pero añadiendo el parametro limit asi en
// funcion de $limit obtenemos ver ultimas entradas o todas
//db_conn nos la acabamos de inventar en la vista recibe $conexion
function mostrar_entradas($db_conn, $limit = null, $categoria = null, $busqueda = null) {

	$slq_select = "SELECT e.*, c.* FROM entradas e\n" .
			"INNER JOIN categorias c\n" .
			"ON e.id_categoria = c.idcategoria\n";

	if (!empty($categoria)) {

		$slq_select .= "WHERE e.id_categoria = $categoria \n";
	}
	if(!empty($busqueda)){
		
		$slq_select .= "WHERE e.titulo LIKE '%$busqueda%' ";
	}

	$slq_select .= "ORDER BY e.identrada DESC \n";

	if ($limit) {

		// $sql = $sql." LIMIT 4";
		$slq_select .= "LIMIT 4";
	}

	//le pasamos una variable $db_conn, que en la vista recibira $conexion(nuestra verdadera var de conexion)
	$ultimas_entradas = mysqli_query($db_conn, $slq_select);


	//creamos array para almacenar resultado de la query
	$result = array();

	if (($ultimas_entradas) && (mysqli_num_rows($ultimas_entradas) >= 1)) {

		// si existe la query le pasamos al array los datos de la consulta
		$result = $ultimas_entradas;
	} else {
		$result = null;
	}

	return $result;
	//$mysqli_free_result0 = mysqli_free_result($ultimas_entradas);
}

##################################################################################
##################################################################################
#**************** VER DETALLE ENTRADA ********************************************

function mostrar_detalle_entrada($db_conn, $identrada) {

	$slq_select = "SELECT e.*,c.nombre_categoria , CONCAT(u.nombre, ' ', u.apellidos) AS usuario "
			. " FROM entradas e "
			. "INNER JOIN categorias c "
			. "ON c.idcategoria = e.id_categoria "
			. "INNER JOIN usuarios u "
			. "ON u.idusuario = e.id_usuario "
			. "WHERE identrada = $identrada";

	//le pasamos una variable $db_conn
	$entradas = mysqli_query($db_conn, $slq_select);

	//creamos array para almacenar resultado de la query
	$result = array();

	if (($entradas) && (mysqli_num_rows($entradas) >= 1)) {

		// si existe la query le pasamos al array los datos de la consulta
		$result = mysqli_fetch_assoc($entradas);
	}

	return $result;

	//$mysqli_free_result = mysqli_free_result($categorias);
}

##################################################################################
##################################################################################
#**************** FORMATEA FECHAS ************************************************

function format_date($fecha_original) {
	$originalDate = $fecha_original;
	$newDate = date("d/m/Y", strtotime($originalDate));
	return $newDate;
}
