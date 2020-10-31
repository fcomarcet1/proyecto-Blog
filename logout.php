<?php

session_start();

if (isset($_SESSION['usuario'])) {
	
	session_destroy();	
}

//redireccion a index.php
header('Location: index.php');

?>

