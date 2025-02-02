<!--Vista para el registro de usuarios -->
<?php ob_start() ?>
	
	<div>
		<div>
			<h1 class="h1Inicio">REGISTRARSE</h1>
		</div>
	</div>
	
	<div>
		<div>
			<?php if(isset($params['mensaje'])) :?>
				<b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
			<?php endif; ?>
		</div>
		<div>
			<?php foreach ($errores as $error) {?>
				<b><span style="color: rgba(200, 119, 119, 1);"><?php echo $error."<br>"; ?></span></b>
			<?php } ?>
		</div>
	</div>
	
	<div>
		<form ACTION="index.php?ctl=registro" METHOD="post" NAME="formRegistro">
			<p>* <input TYPE="text" NAME="nombre" VALUE="<?php echo $params['nombre'] ?>" PLACEHOLDER="Nombre"> <br></p>
			<p>* <input TYPE="text" NAME="apellido" VALUE="<?php echo $params['apellido'] ?>" PLACEHOLDER="Apellido"><br></p>
			<p>* <input TYPE="text" NAME="nombreUsuario" VALUE="<?php echo $params['nombreUsuario'] ?>" PLACEHOLDER="Nombre de usuario"><br></p>
			<p>* <input TYPE="password" NAME="contrasenya" VALUE="<?php echo $params['contrasenya'] ?>" PLACEHOLDER="Contraseña"><br></p>
			<input TYPE="submit" NAME="bRegistro" VALUE="Aceptar"><br>
		</form>
	</div>
		
	<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>