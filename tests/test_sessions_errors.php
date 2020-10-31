<?php
require_once 'includes/conexion.php';
require_once 'includes/lib/mysql.php';

$_SESSION['register_ok'] = "Registo completado con exito.";
$_SESSION['errores']['registro'] = "Error en el registro de usuarios";
$_SESSION['errores']['login'] = "Error en el login de usuarios";
$_SESSION['errores']['categorias']['añadir'] = "Error categorias añadir";
$_SESSION['errores']['categorias']['borrar'] = "Error categorias añadir";



var_dump($_SESSION);

session_unset();


?>
