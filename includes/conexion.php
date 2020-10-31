<?php
include_once 'config.php';

$conexion =  mysqli_connect($host, $username, $password, $database, $port);
mysqli_set_charset($conexion, $encoding);
	
	if(!$conexion) {
       
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL ."<br/>";
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL."<br/>";
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL."<br/>";
        exit;
  }
  /*else { //comentar
        echo "Éxito: Se realizó una conexión apropiada a MySQL!." . PHP_EOL;
        echo "Información del host: " . mysqli_get_host_info($conexion) . PHP_EOL;
    }*/

    
  //inicio de session
  if (!isset($_SESSION)) {

      session_start();
  }