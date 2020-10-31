<?php
    include_once 'includes/lib/redirecc_user_nologin.php';
    include_once 'includes/conexion.php';
    include_once 'includes/header.php';
    include_once 'includes/aside.php';
    //var_dump($_SESSION);
?>

<div id="principal">
    <h1>Modificar Perfil de usuario.</h1>
	<!-- Mostrar mensaje datos update OK -->
	<?php 
	if (isset($_SESSION['update_user_ok']) && !empty($_SESSION['update_user_ok'])) : ?>
		<div class="alerta">
			<?=$_SESSION['update_user_ok']?>
		</div>
	<?php elseif (isset($_SESSION['update_user_error']) && !empty($_SESSION['update_user_error'])): ?>
		<div class="alerta alerta-error">
			<?=$_SESSION['update_user_error']?>
		</div>
	<?php endif; ?>
	
	<?php if (isset($_SESSION['email_exist']) && !empty($_SESSION['email_exist'])): ?>
		<div class="alerta alerta-error">
			<?=$_SESSION['email_exist']?>
		</div>
	<?php endif; ?>
	<h2>Datos personales:</h2>
	<?php echo isset($_SESSION['errores']['campo_vacio']) ? mostrarError($_SESSION['errores'], 'campo_vacio'): '' ?>
	<form action="user_edit_save.php" method="POST">
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombre" id="nombre" maxlength="32" value="<?php echo $_SESSION['usuario']['nombre']?>" 
					   title="El nombre solo puede contener letras May/minusculas. e.g. Frank" required="required" >
					   <?php echo isset($_SESSION['errores']['nombre']) ? mostrarError($_SESSION['errores'], 'nombre'): '' ?>
				<label for="apellidos">Apellidos:</label>
				<input type="text" name="apellidos" id="apellidos" value="<?php echo $_SESSION['usuario']['apellidos']?>"  
					   title="Los apellidos solo pueden contener letras May/minusculas. e.g. Perez Lopez" required="required" >
					    <?php echo isset($_SESSION['errores']['apellidos']) ? mostrarError($_SESSION['errores'], 'apellidos'): '' ?>
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" value="<?php echo $_SESSION['usuario']['email']?>" 
					   title=" Ej:xyz@something.com" required="required" >  
					    <?php echo isset($_SESSION['errores']['email']) ? mostrarError($_SESSION['errores'], 'email'): '' ?>
				<!-- title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" -->
				<!--  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
				 email ->  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$"
				-->
				<label for="password_edit_user">Contraseña:</label>
				<input type="password" name="password" id="password_edit_user" 
					   title="Por favor inserta una contraseña valida." placeholder="Ingresa tu contraseña" required="required"   >
					   <?php echo isset($_SESSION['errores']['password']) ? mostrarError($_SESSION['errores'], 'password'): '' ?>
				<label for="password_repeat_edit_user">Contraseña:</label>
				<input type="password" name="password_repeat" id="password_repeat_edit_user" 
					   title="Por favor inserta una contraseña valida.Ambas contraseñas deben coincidir" 
					   placeholder="Vuelve a ingresar tu contraseña" required="required"   >
					   <?php echo isset($_SESSION['errores']['password_repeat']) ? mostrarError($_SESSION['errores'], 'password_repeat'): '' ?>
					   <?php 
					   if (isset($_SESSION['password_not_same']) && !empty($_SESSION['password_not_same'])): ?>
							<div class="alerta alerta-error">
								<?=$_SESSION['password_not_same']?>
							</div>
					   <?php endif; ?>
					   
				<input type="submit" name="submit" value="Guardar cambios">
			</form>
	<?php borrarErrores(); ?>
</div>

<?php include_once 'includes/footer.php'; ?>