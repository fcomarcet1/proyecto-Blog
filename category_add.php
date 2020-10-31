<?php 
    include_once 'includes/lib/redirecc_user_nologin.php';
    include_once 'includes/conexion.php';
    include_once 'includes/header.php';
    include_once 'includes/aside.php'; 

    //var_dump($_SESSION);

?>

<div id="principal">
    <h1>Nueva categoria.</h1>
    <br/>	
    <div id="categoria_add" class="block-aside">
            <h3>Introduce una nueva categoria:</h3>
            <!--MENSAJE ERROR AÑADIR CATEGORIA Y CATEGORIA OK -->
            <?php if (isset($_SESSION['category_add_ok'])) : ?>
                <div class="alerta alerta-exito">
                     <?=$_SESSION['category_add_ok']?>
                </div>
            <?php elseif (isset($_SESSION['category_add_error'])): ?>  
                <div class="alerta alerta-error">
                    <?=$_SESSION['category_add_error']?>
                </div>
            <?php endif ?>  
             
			<form action="category_save.php" method="POST">
                <label for="nombre_categoria">Categoria:</label>
                <input type="text" name="nombre_categoria" id="nombre_categoria"  autofocus="autofocus" required ="required">
                <!-- validamos que esiste el error y llamamos a la funcion mostrarError() --> 
                <?php if (isset($_SESSION['errors_category_add']['error_name_category_add'])) :?> 
                    <span class = "alerta alerta-error">
                        <?php echo $_SESSION['errors_category_add']['error_name_category_add'] ; ?></span>
                <?php endif;?>
                
                <input type="submit" name="submit" value="Añadir Categoria">
            </form>
            <div id="ver-inicio">
		        <a href="index.php">Volver a inicio</a>
	        </div>	
            <!--LIMPIAMOS ERRORES DEL FORMULARIO-->
            <?php borrarErrores() ?> 
</div><!-- FIN PRINCIPAL--> 


<?php include_once 'includes/footer.php'; ?>










