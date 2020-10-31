<?php

//desconexion base de daros

  function disconnectDB($conexion) {
	  
	  $close = mysqli_close($conexion);
	  unset($conexion);
	  
	  return $close;
	  
}

//limpiar recursos memoria del servidor
function cleanMemory($query) {
	
	$clean_memory = mysqli_free_result($query);
	
	return $clean_memory;	
}



?>