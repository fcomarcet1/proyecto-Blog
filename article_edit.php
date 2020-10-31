<?php
//NOTA
//VAMOS A REUTILIZAR PARA GUARDAR LA MODIFICACION DE UNA ENTRADA LA PAGINA QUE USAMOS CUANDO GUARDAMOS
//UNA ENTRADA article_save.php PASANDO UN PARAMETRO POR GET CUANDO SEA EN ESTE CASO EDITAR, ASI NO 
//TENEMOS QUE HACER UNA NUEVA PAGINA ÀRA GUARDAR LA ENTRADA MODIFICADA.
include_once 'includes/lib/redirecc_user_nologin.php';
include_once 'includes/lib/helpers.php';
include_once 'includes/conexion.php';
include_once 'includes/header.php';
include_once 'includes/aside.php';
//var_dump($_SESSION);

$id_entrada = $_GET['identrada'];
$entrada_actual = mostrar_detalle_entrada($conexion, $id_entrada);
//$id_categoria = $_GET['idcategoria'];
$id_user = $_SESSION['usuario']['idusuario'];

//comprobamos que el id  que viene por get existe en nuestra bd
if (!isset($entrada_actual['identrada'])) {
	header('Location: index.php');
}

	//var_dump($entrada_actual);
	//var_dump($_GET);
	//die();

?>

<div id="principal">
    <h1>Editar entrada.</h1>
    <br/>	
    <div id="categoria_add" class="block-aside">
		<h3>Edita tu entrada: <?=$entrada_actual['titulo'] ?></h3>
		<!--MENSAJE AÑADIR ENTRADA ERROR AMBOS CAMPOS VACIOS -->
<?php ?>
		<form action="article_save.php?editar=<?=$entrada_actual['identrada'] ?>" method="POST">
			<label for="titulo">Titulo:</label>
			<input type="text" name="titulo" id="titulo" value="<?=$entrada_actual['titulo'] ?>" >
			<?php echo isset($_SESSION['errors_article_add']) ? mostrarError($_SESSION['errors_article_add'], 'titulo') : '' ?>
			<label for="descripcion">Descripcion:</label>
			<textarea id="descripcion" name="descripcion" rows="20" cols="80"><?=$entrada_actual['descripcion'] ?>"</textarea>
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
					<!-- Ternaria para la lista de seleccion y muestre la categoria seleccionada del articulo -->
					<option value="<?=$categoria['idcategoria']?>"
					<?=$categoria['idcategoria'] == $entrada_actual['id_categoria']  ? 'selected="selected"' : ''  ?>	>
						<?=$categoria['nombre_categoria']?>
					</option>		
					<?php endwhile; 
					
				 endif; ?>
				</select>	
			
			<!-- validamos que existe el error y llamamos a la funcion mostrarError() -->
			<?php echo isset($_SESSION['errors_article_add']) ? mostrarError($_SESSION['errors_article_add'], 'categoria') : '' ?>
			<input type="submit" name="submit" value="Modificar entrada">
		</form>
		<!--LIMPIAMOS ERRORES DEL FORMULARIO-->
		<?php borrarErrores() ?> 
	</div><!-- FIN PRINCIPAL--> 


	<?php include_once 'includes/footer.php'; ?>