
<?php require_once 'lib/helpers.php'; ?>

<aside id="sidebar">
	<!-- BARRA DE BUSQUEDA-->
	<div id="registro" class="block-aside">
		<h3>Buscador</h3>
		<form action="search_bar.php" method="POST">
				<label for="busqueda">Buscar entradas:</label>
				<input type="text" name="busqueda" id="busqueda">	
				<input type="submit" name="submit_search" value="Buscar">
		</form>
	</div>
	<!-- ALERTA CREDENCIALES LOGIN -->
	<?php if (isset($_SESSION['usuario'])): ?>
	
		<div id="user-login-ok" class="block-aside">
			<h4>Bienvenido:<?= $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellidos']; ?></h4>
			<!-- BOTONES -->
			<a class="boton boton-naranja " href="user_edit.php">Mi perfil</a>
			<a class="boton" href="category_add.php">Añadir categoria</a>
			<a class="boton boton-verde" href="article_add.php">Añadir entrada</a>
			<a class="boton boton-rojo" href="logout.php">Logout</a>
		</div>
	
	<?php endif; ?>
	
	<!--  SOLO MOSTRAMOS FORM LOGIN Y REGISTRO SI NO ESTAS LOGUEADO-->
	<?php if (!isset($_SESSION['usuario'])): ?>
		<div id="login" class="block-aside">

			<h3>Identificate:</h3>
			
			<!-- ALERTA LOGIN INCORRECTO -->
			<?php if (isset($_SESSION['error_login'])): ?>
				<div class="alerta alerta-error">
					<?= $_SESSION['error_login']; ?>
				</div>
			<?php endif; ?>
			<form action="login.php" method="POST">
				<label for="email">Email</label>
				<input type="email" name="email" id="name">
				<label for="password_login">Contraseña</label>
				<input type="password" name="password" id ="password_login">

				<input type="submit" name="submit_register" value="Acceder">
			</form>

		</div>
		<div id="registro" class="block-aside">
			<h3>Registrate:</h3>

			<!--  MOSTRAR ERRORES REGISTRO Y REGISTRO OK -->
			<?php if (isset($_SESSION['register_ok'])): ?>

				<div class="alerta alerta-exito">
					<?= $_SESSION['register_ok'] ?>
				</div>

			<?php elseif (isset($_SESSION['errores']['registro'])): ?>

				<div class="alerta alerta-error">
					<?= $_SESSION['errores']['registro'] ?>
				</div>

			<?php endif; ?>

			<?php //if (isset($_SESSION['errores'])):?>
			<?php //var_dump($_SESSION['errores'])?>
			<?php //endif;?>

			<form action="register.php" method="POST">

				<!-- PROBAR en input value="'.$_SESSION['user_first_name'].'" -->
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombre" id="nombre" maxlength="32" title="El nombre solo puede contener letras May/minusculas. e.g. Frank" required >
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '' ?>

				<label for="apellidos">Apellidos:</label>
				<input type="text" name="apellidos" id="apellidos"  title="Los apellidos solo pueden contener letras May/minusculas. e.g. Perez Lopez" required>
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '' ?>

				<label for="email">Email:</label>
				<input type="email" name="email" id="email" title="xyz@something.com" 
					   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$" required >  
					   <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '' ?>

				<!-- title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" -->
				<!--  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" -->
				<label for="password_registro">Contraseña:</label>
				<input type="password" name="password" id="password_registro" title="Por favor inserta uan contraseña valida."  required >
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : '' ?>
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : '' ?>

				<input type="submit" name="submit" value="Registrarse">
			</form>
			<!-- Eliminamos errores de $_SESSION['errores'] con la funcion de lib/helpers.php -->
			<?php borrarErrores(); ?>
		</div>
	<?php endif; ?>
</aside>

