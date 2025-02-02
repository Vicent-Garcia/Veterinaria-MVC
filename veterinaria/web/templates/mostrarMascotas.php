<!--Lista las mascotas que tiene registradas un usuario en una tabla, desde aquí se pueden subir fotos de las mascotas.
 Si no se sube foto, se asigna predeterminada -->


<?php ob_start();
if (isset($params['mensaje'])) { 
	echo $params['mensaje'] ;
} 
if (isset($params['mascotas']) && is_array($params['mascotas']) && count($params['mascotas']) > 0);
?>
<table class="tabla">
	<tr>
		<th><h4><b>Mascotas de <?php echo $_SESSION['nombre']?></b></h4><br></th>		
	</tr>
	<tr class="cabecera">
		<td>Nombre</td>
		<td>Edad</td>
		<td>Raza</td>
		<td>Foto</td>
		<td></td>
	</tr>
	<?php foreach ($params['mascotas'] as $mascota) :?>
	<tr>
		<td><?php echo $mascota['nombreMascota'] ?></td>
		<td><?php echo $mascota['edad'] ?></td>
		<td><?php echo $mascota['raza'] ?></td>
		<td>
			<?php 
			$rutaImagen = 'img/mascotas/' . $mascota['ID'] . '.jpg';
			if (file_exists($rutaImagen)) {
				echo '<img src="' . $rutaImagen . '" style="height: 70px;" class="fotoSaludo" alt="Foto de mascota">';
			} else {
				echo '<img src="img/mascotas/avatar-perro-gato.jpg" style="height: 70px;" class="fotoSaludo" alt="Foto de mascota">';
			}
			?>
		</td>
		<td><form action="index.php?ctl=subirFotoMascota" method="POST" enctype="multipart/form-data">
				<input name="archivo" id="archivo" type="file"/>
				<input name="mascotaID" id="mascotaID" type="hidden" value="<?php echo $mascota['ID'] ?>"/> 
				<input type="submit" name="subirMascota" value="Subir imagen"/>
			</form></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>