<?php include_once './includes/conexion.php'; ?>
<?php require_once './includes/lib/helpers.php'; ?>
<?php require_once './includes/header.php'; ?>
<!--SIDE BAR -->
<?php include_once './includes/aside.php';

/****************************************************** */
/***********PAGINACION***********************************/

?>
<!--CAJA PRINCIPAL -->
<div id="principal">
	<h1>Todas las entradas</h1>
	<!--  MOSTRAR ULTIMAS ENTRADAS.-->
	<?php
	//llamamos a la funcion mostrar_entradas($conn,$limit=null) parametrizada
	$ultimas_entradas = mostrar_entradas($conexion, null, null) ;
	if (!empty($ultimas_entradas)):
		while ($ultima_entrada = mysqli_fetch_assoc($ultimas_entradas)) :
			?>
			<article class="entrada">
				<a href="article.php?identrada=<?=$ultima_entrada['identrada']?>">
					<h2><?= $ultima_entrada['titulo'] ?></h2>
					<?php $fecha_formateada = format_date($ultima_entrada['fecha_entrada']) ?>
					<span class="fecha_categoria"><?= $ultima_entrada['nombre_categoria'] . " | " . $fecha_formateada ?></span>
					<!--  con subtr limitamos el numero  de caracteres a mostrar desde el 0 al 200 -->
					<p><?= substr($ultima_entrada['descripcion'], 0, 200) . "..." ?></p>
				</a>
			</article>
			<?php
		endwhile;
	endif;
	?>
	
</div><!-- FIN PRINCIPAL-->

<!--FOOTER -->
<?php include_once './includes/footer.php'; ?>

