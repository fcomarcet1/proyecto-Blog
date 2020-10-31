<?php include_once './includes/conexion.php'; ?>
<?php require_once './includes/lib/helpers.php'; ?>
<?php require_once './includes/header.php'; ?>
<!--SIDE BAR -->
<?php include_once './includes/aside.php'; ?>
<!--CAJA PRINCIPAL -->
<div id="principal">
	<h1>Ultimas entradas</h1>
	
	<!--MENSAJE AÑADIR ENTRADA OK -->
	 <?php if((isset($_SESSION['article_add_ok'])) && (!empty($_SESSION['article_add_ok'])) ) : ?>
		<div class="alerta">
			<?=$_SESSION['article_add_ok']?>
		</div>
	<?php endif; ?>
	
	<!--MENSAJE BORRAR ENTRADA OK -->
	 <?php if((isset($_SESSION['delete_ok'])) && (!empty($_SESSION['delete_ok'])) ) : ?>
		<div class="alerta">
			<?=$_SESSION['delete_ok']?>
		</div>
	<?php endif; ?>
	
	<!--MENSAJE BORRAR ENTRADA ERROR -->
	 <?php if((isset($_SESSION['delete_article_error'])) && (!empty($_SESSION['delete_article_error'])) ) : ?>
		<div class="alerta alerta-error">
			<?=$_SESSION['delete_article_error']?>
		</div>
	<?php endif; ?>
	
	<!--MENSAJE EDITAR ENTRADA OK -->
	 <?php if((isset($_SESSION['article_edit_ok'])) && (!empty($_SESSION['article_edit_ok'])) ) : ?>
		<div class="alerta ">
			<?=$_SESSION['article_edit_ok']?>
		</div>
	<?php endif; ?>
	
	<!--MENSAJE EDITAR ENTRADA ERROR -->
	 <?php if((isset($_SESSION['article_edit_error'])) && (!empty($_SESSION['article_edit_error'])) ) : ?>
	
				<div class="alerta alerta-error">
					<?=$_SESSION['article_edit_error']?>
				</div>
	<?php endif; ?>
	

	<!--  MOSTRAR ULTIMAS ENTRADAS.-->
	<?php $ultimas_entradas = mostrar_entradas($conexion, true, null) ;
	if(!empty($ultimas_entradas)):
		while($ultima_entrada = mysqli_fetch_assoc($ultimas_entradas)) : ?>
			<article class="entrada">
				<a href="article.php?identrada=<?=$ultima_entrada['identrada']?>">
					<h2><?=$ultima_entrada['titulo']?></h2>
					<?php $fecha_formateada = format_date($ultima_entrada['fecha_entrada']) ?>
					<span class="fecha_categoria"><?=$ultima_entrada['nombre_categoria'] . " | " . $fecha_formateada ?></span>
					<!--  con subtr limitamos el numero  de caracteres a mostrar desde el 0 al 170 -->
					<p><?= substr($ultima_entrada['descripcion'], 0,200) ."..." ?></p>
				</a>
			</article>
		<?php endwhile; 
	endif;
	?>
		
	<div id="ver-todas">
		<a href="articles_all_view.php">Ver todas las entradas</a>
	</div>
<!-- LIMPIAR ERRORES-->
<?php borrarErrores(); ?>
</div><!-- FIN PRINCIPAL-->

<!--FOOTER -->
<?php include_once './includes/footer.php'; ?>