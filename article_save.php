<?php

if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['submit']))) {
	
    include_once 'includes/conexion.php';
    include_once 'includes/lib/redirecc_user_nologin.php';

    //VAlidamos que nos llegan todos los campos
    if (isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['categoria'])) {
		
		
		//VARIABLES.
        $errores= array();
        //$errores_campos_vacios = array();
        
        $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($conexion, trim($_POST['titulo'])) : false;
        //creo que no es necesario formatear con un trim() la descripcion
        $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($conexion, ($_POST['descripcion'])) : false;
        
        // La categoria llega como string necesitamos formatearlo a int para validarlo
        $categoria = isset($_POST['categoria']) ? mysqli_real_escape_string($conexion, (int)($_POST['categoria'])) : false;
        
        // Para realizar el INSERT necesitamos tambien el idusuario, lo obtenemos de la variable de session
        $id_usuario = $_SESSION['usuario']['idusuario'];
		
		
         //VALIDACION DE CAMPOS
        if (empty($titulo) && empty($descripcion)) { //Validamos si ambos campos estan vacios.
            
            $entrada_validate = false;
            $errores['titulo_descrip_empty'] = "Campo titulo y descripcion vacios.";
        } 
		elseif (empty($titulo)) { // TITULO: solo campo titulo vacio.
            
            $entrada_validate = false;
            $errores['titulo'] = "Campo titulo vacio.";
        } 
		elseif (empty($descripcion)) { // DESCRIPCION:solo campo descripcion vacio
            
            $entrada_validate = false;
            $errores['descripcion'] = "Campo descripcion vacio.";
        }

        //CATEGORIA
        if ( (empty($categoria)) && (!is_numeric($categoria)) ) {
            
            $entrada_validate = false;
            $errores['categoria']= "Error al seleccionar la categoria.";
        }
		
		
		
        //VALIDACION DE ERRORES
        $save_article = false;
		$count = count($errores);
		
		
		// esta parte la usamos para guardar los datos cuando editamos una entrada validando si recibe
		// por $_get el parametro editar
        if($count == 0) {
			
			if (isset($_GET['editar'])) {
				
				$entrada_id = $_GET['editar'];
					
				//update
				$sql = " UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion', id_categoria = $categoria "
						. " WHERE identrada = $entrada_id AND id_usuario = $id_usuario ";
				
		
				$article_edit = mysqli_query($conexion, $sql);

				if ($article_edit) {//UPDATE OK

					$edit_article = true;
					$_SESSION['article_edit_ok'] = "Entrada modificada correctamente.";
					header('Location: index.php ');

				}
				else{ //error UPDATE

					$edit_article = false;
					$_SESSION['article_edit_error'] ="Error al modificar la entrada.";
					header('Location: article_edit.php');
				}
				
			}
			else{
				// INSERT
				$sql = "INSERT INTO entradas (id_usuario, id_categoria, titulo, descripcion) "
			
						. "VALUES ($id_usuario, $categoria, '$titulo', '$descripcion') ";
				
				$article_save = mysqli_query($conexion, $sql);

				if ($article_save) {

					$save_article = true;
					$_SESSION['article_add_ok'] = " Nueva Entrada añadida correctamente.";
					header('Location: index.php ');

				}
				else{ //error INSERT

					$save_article = false;
					$_SESSION['article_add_error'] ="Error al añadir la nueva entrada.";
					header('Location: article_add.php');
				}
			}
				  
        }
        else { //END count errors
            // existen errores en los arrays de errores
            //creamos las variables de sesion con los errores
            $_SESSION['errors_article_add'] = $errores; // errores de campos especificos
			
			if(isset($_GET['editar'])){
				
				header("Location: article_edit.php?identrada=".$_GET['editar']);
			}
			else{
				header('Location: article_add.php');
			}
		
            
        }

    }// END isset

}//END $_SERVER['REQUEST_METHOD'] === 'POST'
