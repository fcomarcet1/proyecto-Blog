<?php
include_once './includes/conexion.php';
include_once './includes/lib/redirecc_user_nologin.php';  

//comprobamos que el usuario esta identificado y que llega el identrada por $_get
if (isset($_SESSION['usuario']) && isset($_GET['identrada'])) {
	
	$id_entrada = $_GET['identrada'];
	$id_user = $_SESSION['usuario']['idusuario'];
	//var_dump($_SESSION);
	//var_dump($_GET);
	$sql_delete = "DELETE FROM entradas "
				. "WHERE identrada = $id_entrada "
				. "AND id_usuario = $id_user";
	$delete = mysqli_query($conexion, $sql_delete);
	
	//$errores = array();
	$delete_article = false;
	
	if ($delete) {
		$delete_article = true;
		$_SESSION['delete_ok']= "Entrada eliminada correctamente.";
		header('Location: index.php');
	}
	else{
		//error delete
		$delete_article = false;
		$_SESSION['delete_article_error'] = " Error la entrada no se pudo eliminar.Por favor vuelve a intentarlo";
		header('Location: article.php');		
	}
	
}





?>
