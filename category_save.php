<?php 
include_once 'includes/conexion.php';
include_once 'includes/lib/redirecc_user_nologin.php';

if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['submit']))) {
    
    if (isset($_POST['nombre_categoria'])) {

        //array para  controlar errores
        $errores_categorias = array();
        $categoria = mysqli_real_escape_string($conexion, ($_POST['nombre_categoria']));

        
        // Comprobacion que no llega vacio el campo 
        if(!empty($categoria) && !is_numeric($categoria) && !preg_match("/[0-9]/", $categoria)){
            $nombre_validate = true;
        }
        else{
            $nombre_validate = false;
            $errores_categorias['error_name_category_add'] = "El nombre no es válido";
        }
            
        if (empty($categoria)) {

            $categoria_validate =false;
            $errores_categorias['error_name_category_add'] = "Campo vacio, por favor inserte una categoria.";

        }

        /* NO FUNCIONA BIEN CUANDO ESTA VACIO TOMA EL VALOR 
                    $errores_categorias['error_name_category_add'] = "Nombre de categoria no valido.Solo puede contener May/min o nums";

        if (empty($categoria)) {

            $categoria_validate =false;
            $errores_categorias['error_name_category_add'] = "Campo vacio, por favor inserte una categoria.";

        } 

        if ((!preg_match("/[A-Za-z0-9 ]/", $categoria))) {

            $categoria_validate =false;
            $errores_categorias['error_name_category_add'] = "Nombre de categoria no valido.Solo puede contener May/min o nums";
        }
        */


        // validacion que no exixten errores para ejecutar el insert
        $categoria_save = false;

        if (count($errores_categorias) == 0) {
            
            // Al no existir errores vamos a ejecutar el insert en la BD
            $categoria = mysqli_real_escape_string($conexion, trim($_POST['nombre_categoria']));
            $categoria_save =true;
            $sql = "INSERT INTO categorias (nombre_categoria) VALUES ('$categoria')";
            $insert_categorias = mysqli_query($conexion, $sql);
    
            if ($insert_categorias) {

                $categoria_save = true;
                $_SESSION['category_add_ok'] = "Categoria añadida correctamente";

            } else {

                $categoria_save = false;
                $_SESSION['category_add_error'] = "Error al añadir la nueva categoria si persiste ponte en contacto con el administrador.";
            }
        } else {//Existen errores creamos variables de sesion con el array de errores
            
            $_SESSION['errors_category_add'] = $errores_categorias;
            header('Location: category_add.php');
        }
    }
}
  
header('Location: category_add.php');
?>