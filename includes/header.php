<?php require_once 'conexion.php'; ?>
<?php require_once 'lib/helpers.php'; ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Blog de Videojuegos con PHP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="assets/css/estilos.css"/>
		<script type="text/javascript" src="./assets/js/confirm_delete.js"></script>
    <body>
        <!--CABECERA -->
        <header id="header">
            <!--LOGO -->
            <div id="logo">
                <h2><a href="index.php">MyRetro Games Blog</a></h2>
            </div>

            <!--MENU -->			
            <nav id="menu">
                <ul>
                    <li>
						<a href="index.php">Inicio</a>
					</li>
					<!-- LLAMADA A FUNCION mostrar_categorias(); -->
					<?php
					$categorias = mostrar_categorias($conexion);

					//MOSTRAMOS CATEGORIAS.
					if (isset($categorias) && !empty($categorias)):
						while ($categoria = mysqli_fetch_assoc($categorias)):
							?>
							<li>
								<!-- < echo $categoria['idcategoria'] ?> es similar a  -->
								<a href="category_view.php?idcategoria=<?=$categoria['idcategoria']?>"><?=$categoria['nombre_categoria']?></a>
							</li>
						<?php endwhile;
					endif;
					?>	
                    <li>
						<a href="index.php">Sobre mi</a>
					</li>
                    <li>
						<a href="index.php">Contacto</a>
					</li>
                </ul>    
            </nav>
			<div class="clearfix"></div>
        </header>

		<!--CONTENIDO -->
		<div id="container">

