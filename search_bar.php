<?php
	if(!isset($_POST['busqueda'])){
		header("Location: index.php");
	}
?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/aside.php'; ?>
		
<!-- CAJA PRINCIPAL -->
<div id="principal">

	<h1>Busqueda: <?=$_POST['busqueda']?></h1>
	
	<?php 
		$ultimas_entradas = mostrar_entradas($conexion, null, null, $_POST['busqueda']);

		if(!empty($ultimas_entradas) && mysqli_num_rows($ultimas_entradas) >= 1):
			while($entrada = mysqli_fetch_assoc($ultimas_entradas)): ?>
				<article class="entrada">
					<a href="article.php?identrada=<?=$entrada['identrada']?>">
						<h2><?= $entrada['titulo'] ?></h2>
						<?php $fecha_formateada = format_date($entrada['fecha_entrada']) ?>
						<span class="fecha_categoria"><?= $entrada['nombre_categoria'] . " | " . $fecha_formateada ?></span>
						<!--  con subtr limitamos el numero  de caracteres a mostrar desde el 0 al 200 -->
						<p><?= substr($entrada['descripcion'], 0, 200) . "..." ?></p>
					</a>
			</article>
	<?php
			endwhile;
		else:
	?>
		<div class="alerta">No hay entradas en esta categoría</div>
	<?php endif; ?>
</div> <!--fin principal-->
			
<?php require_once 'includes/pie.php'; ?>