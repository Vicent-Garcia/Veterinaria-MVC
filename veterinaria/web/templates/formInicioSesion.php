<!--Vista de inicio de sesión. Utilizando el búfer podemos enviar el contenido de esta vista a layout.php  -->

<?php ob_start() ?>
	
	<div>
		<div>
			<h1>Registro en la clínica</h1>
		</div>
	</div>

	<div>
		<div>
			<?php if(isset($params['mensaje'])) :?>
				<b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
			<?php endif; ?>
		</div>
	</div>
	
	<div>
		<form ACTION="index.php?ctl=iniciarSesion" METHOD="post" NAME="formIniciarSesion">
			<h5><b>Iniciar sesión</b></h5>
			<p><input TYPE="text" NAME="nombreUsuario" PLACEHOLDER="Nombre de usuario"><br></p>
			<p><input TYPE="password" NAME="contrasenya" PLACEHOLDER="Contraseña"><br></p>	
			<input TYPE="submit" NAME="bIniciarSesion" VALUE="Aceptar"><br>
		</form>	
	</div>
	

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>