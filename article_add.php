<?php
    include_once 'includes/lib/redirecc_user_nologin.php';
    include_once 'includes/conexion.php';
    include_once 'includes/header.php';
    include_once 'includes/aside.php';
    //var_dump($_SESSION);
?>

<div id="principal">
    <h1>Nueva entrada.</h1>
    <br/>	
    <div id="categoria_add" class="block-aside">
            <h3>Introduce una nueva entrada para el blog:</h3>
			<?php if((isset($_SESSION['article_edit_error'])) && 
				(!empty($_SESSION['article_edit_error'])) ) : ?>
					<div class="alerta alerta-error">
						<?=$_SESSION['article_edit_error']?>
					</div>
			<?php endif; ?>
            <!--MENSAJE AÑADIR ENTRADA ERROR AMBOS CAMPOS VACIOS -->
			<?php if((isset($_SESSION['errors_article_add']['titulo_descrip_empty'])) && 
					(!empty($_SESSION['errors_article_add']['titulo_descrip_empty'])) ) : ?>
						<div class="alerta alerta-error">
							<?=$_SESSION['errors_article_add']['titulo_descrip_empty'] ?>
						</div>
			<?php endif; ?>
			<form action="article_save.php" method="POST">
				
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" >
                <?php echo isset($_SESSION['errors_article_add']) ? mostrarError($_SESSION['errors_article_add'], 'titulo') : '' ?>
                
				<label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea>
				<?php echo isset($_SESSION['errors_article_add']) ? mostrarError($_SESSION['errors_article_add'], 'descripcion') : '' ?>
                <br/> 
                <br/> 
				
				<!-- LISTA DE SELECCION CATEGORIAS OJO CON NO METER EL WHILE FUERA DEL SELECT(no envia idcategoria) -->
                <!-- Para mostrar las categorias en el select usamos la funcion mostrar_categorias que usamos en el menu -->
                <label for="categoria">Categoria:</label>
				<select name="categoria" id="categoria">
                <?php 
				$categoria_ver = mostrar_categorias($conexion); 
				if((isset($categoria_ver))&&(!empty($categoria_ver))) : 
					
					while($categoria = mysqli_fetch_assoc($categoria_ver)):?>
					<option value="<?=$categoria['idcategoria']?>" >
						<?=$categoria['nombre_categoria']?>
					</option>		
					<?php endwhile; 
					
				 endif; ?>
				</select>	
                <!-- validamos que existe el error y llamamos a la funcion mostrarError() -->
				<?php echo isset($_SESSION['errors_article_add']) ? mostrarError($_SESSION['errors_article_add'], 'categoria') : '' ?>
                <input type="submit" name="submit" value="Nueva entrada">
            </form>
			
            <!--LIMPIAMOS ERRORES DEL FORMULARIO-->
            <?php borrarErrores() ?> 
</div><!-- FIN PRINCIPAL--> 


<?php include_once 'includes/footer.php'; ?>