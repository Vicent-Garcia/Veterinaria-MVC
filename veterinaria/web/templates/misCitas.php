<!-- Muestra las citas que el usuario tiene, puede solicitar una cita nueva -->

<?php ob_start();
$mascotas = $params['mascotas'];?>

<div>
<h2>Próximas citas</h2>
<table class="tabla">
	<tr class="cabecera">
		<td>Mascota</td>
		<td>Fecha</td>
		<td>Comentario</td>
	</tr>
	<?php foreach ($params['citas'] as $cita) :?>
	<tr>
		<td><?php
			$mascotaID = $cita['mascota'];
			foreach ($params['mascotas'] as $mascota) {
				if ($mascota['ID'] == $mascotaID) {
					echo $mascota['nombreMascota'];
					break;
				}
			}
	?></td>
		<td><?php echo $cita['fecha'] ?></td>
		<td><?php echo $cita['comentario'] ?></td>
	</tr>
	<?php endforeach; ?>
</table>
</div>

<div class="formCitas">
		<h2>Quiero pedir una cita</h2>
		<form ACTION="index.php?ctl=pedirCita" METHOD="post" NAME="formCitas">
			<p>Para mi mascota: <select name="mascota" id="mascota">
				<option value="">Seleccione...</option>
				<?php foreach ($params['mascotas'] as $mascota): ?>
					<option value="<?= htmlspecialchars($mascota['ID']) ?>">
                <?= htmlspecialchars($mascota['nombreMascota']) ?>
            </option>
				<?php endforeach; ?>
			</select> <br></p>
			<p>Preferencia fecha: <input type="date" id="fecha" name="fecha"><br></p>
			<p>Comentarios: <textarea name="comentario" id="comentario" rows="4" cols="50" placeholder="Escriba aquí su comentario..."></textarea></p>
			<input TYPE="submit" NAME="bPedirCita" VALUE="Confirmar cita"><br>
		</form>
	</div>


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>