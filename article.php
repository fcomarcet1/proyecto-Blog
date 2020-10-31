<?php require_once './includes/lib/helpers.php'; ?>
<?php include_once './includes/conexion.php'; ?>
<?php
/*Para evitar que por la url se meta una categoria que no existe y falle la app vamos a
 *comprobar que existe el id de la categoria y sino redireccion a index.php por esto incluimos
 * este script incluso antes de los includes 
*/

$id_entrada = $_GET['identrada'];
$entrada_detalle = mostrar_detalle_entrada($conexion, $id_entrada);
//var_dump($entrada_detalle);
//var_dump($_SESSION);
//die();

if (!isset($entrada_detalle['identrada'])) {
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
	
	<h1><?=$entrada_detalle['titulo']?></h1>
	<a href="category_view.php?idcategoria=<?=$entrada_detalle['id_categoria']?>">
		<h2><?=$entrada_detalle['nombre_categoria']?></h2>
	</a>
	<h4><?= format_date($entrada_detalle['fecha_entrada']) ." | ".$entrada_detalle['usuario']?></h4>
	<p><?=$entrada_detalle['descripcion']?></p>
	<br/><br/>
	<?php if(isset($_SESSION['usuario']) && ($entrada_detalle['id_usuario'] == $_SESSION['usuario']['idusuario']) ) : ?>
			
		<a class="boton" href="article_edit.php?identrada=<?=$entrada_detalle['identrada']?>">Editar entrada</a>
		<a class="boton boton-rojo" onclick="return Confirmation()" href="article_delete.php?identrada=<?=$entrada_detalle['identrada']?>">Eliminar entrada</a>
			
	<?php endif;?>	
	
</div><!-- FIN PRINCIPAL-->
<div class="clearfix"></div>

<!-- SOLO SE MOSTRARAN BOTONES EDITAR Y BORRAR ENTRADA SI ES EL AUTOR DEL ARTICULO -->

<!--FOOTER -->
<?php include_once './includes/footer.php'; ?>