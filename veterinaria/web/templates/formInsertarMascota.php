<!--Vista de registrar mascotas, solo el admin puede acceder  -->

<?php ob_start(); ?>

<div>
	<div>
			<?php if(isset($params['mensaje'])) :?>
				<b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
			<?php endif; ?>
	</div>
</div>

<div>
			<?php foreach ($errores as $error) {?>
				<b><span style="color: rgba(200, 119, 119, 1);"><?php echo $error."<br>"; ?></span></b>
			<?php } ?>
</div>

<div>
	<div>
		<form ACTION="index.php?ctl=insertarMascota" METHOD="post">
			<p>* <input TYPE="text" NAME="nombreMascota" PLACEHOLDER="Nombre de la mascota"><br></p>
			<label for="familiar"> * Selecciona al familiar responsable:</label>
			<select name="familiar" id="familiar">
				<option value="">Seleccione...</option>
				<?php foreach ($usuarios as $usuario): ?>
					<option value="<?= htmlspecialchars($usuario['ID']) ?>">
                <?= htmlspecialchars($usuario['nombre']) ?>
            </option>
				<?php endforeach; ?>
			</select>
			<p>* <input TYPE="text" NAME="edad" PLACEHOLDER="Edad"><br></p>
			<p>*  <input TYPE="text" NAME="raza" PLACEHOLDER="Raza"><br></p>	
			<input TYPE="submit" name="bInsertarMascota" VALUE="Aceptar" PLACEHOLDER="Nombre de usuario"><br>
		</form>
	</div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
