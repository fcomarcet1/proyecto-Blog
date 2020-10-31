<?php 

require_once '../../includes/conexion.php';
require_once '../../includes/lib/helpers.php';
require_once '../../includes/header.php';
require_once '../../includes/aside.php';




?>



<div id="principal">
    <h1>Nueva categoria.</h1>
    <br/>	
    <div id="categoria_add" class="block-aside">
			<h3>Introduce una nueva categoria:</h3>
			<form action="category_save.php" method="POST">
				<label for="nombre_categoria">Categoria:</label>
				<input type="text" name="nombre_categoria" id="nombre_categoria">
		
				<input type="submit" name="submit" value="Añadir Categoria">
			</form>
</div><!-- FIN PRINCIPAL--> 


<?php include_once '../../includes/footer.php'; ?>