<form action="register_victor.php" method="POST">

	<!-- PROBAR en input value="'.$_SESSION['user_first_name'].'" -->
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" id="nombre" maxlength="32" pattern="[A-Za-z ]+" 
		   title="El nombre solo puede contener letras May/minusculas. e.g. Frank" required >
		   <?php //echo mostrarError($_SESSION['errores'], 'nombre'); ?>

	<label for="apellidos">Apellidos</label>
	<input type="text" name="apellidos" id="apellidos" pattern="[A-Za-z ]+" 
		   title="El nombre solo puede contener letras May/minusculas. e.g. Perez Lopez" required >
		   <?php //echo mostrarError($_SESSION['errores'], 'apellidos'); ?>

	<label for="email">Email</label>
	<input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$"
		   title="xyz@something.com" required >
		   <?php //echo mostrarError($_SESSION['errores'], 'email'); ?>

	<!-- title="Must contain at least one  number and one uppercase and lowercase letter, and at least 5 or more characters" -->
	<!--  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" -->
	<label for="password">Contraseña</label>
	<input type="password" name="password" id="password" required >
	<?php //echo mostrarError($_SESSION['errores'], 'password'); ?>

	<input type="submit" name="submit" value="Registrarse">
</form>

