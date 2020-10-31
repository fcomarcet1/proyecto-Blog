<?php require_once './includes/lib/helpers.php'; ?>
<?php include_once './includes/conexion.php'; ?>
<?php
/*Para evitar que por la url se meta una categoria que no existe y falle la app vamos a
 *comprobar que existe el id de la categoria y sino redireccion a index.php por esto incluimos
 * este script incluso antes de los includes 
*/

$id_category = $_GET['idcategoria'];
$categoria_actual = mostrar_categoria($conexion, $id_category);

//var_dump($categoria);
//die();

if (!isset($categoria_actual['idcategoria'])) {
	header('Location: index.php');
}
	
?>

<?php require_once './includes/header.php'; ?>
<!--SIDE BAR -->
<?php include_once './includes/aside.php';

/****************************************************** */
/***********PAGINACION***********************************/

?>
<!--CAJA PRINCIPAL -->
<div id="principal">
	
	<h1>Entradas de: <?=$categoria_actual['nombre_categoria']?> </h1>
	<!--  MOSTRAR ULTIMAS ENTRADAS.-->
	<?php
	//llamamos a la funcion mostrar_entradas($conn,$limit=null) parametrizada
	$ultimas_entradas = mostrar_entradas($conexion,null, $id_category) ;
	if ((!empty($ultimas_entradas)) && (mysqli_num_rows($ultimas_entradas) >= 1)):
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
	else:?>
		<div class="alerta">
			<p>No existen entradas de esta categoria</p>
		</div>
	<?php 
	endif;
	?>
	
</div><!-- FIN PRINCIPAL-->

<!--FOOTER -->
<?php include_once './includes/footer.php'; ?>