<!--   muestra las citas que los clientes han solicitado -->

<?php ob_start() ?>

<h2>Citas: </h2>
<table class="tabla">
	<tr class="cabecera">
        <td>Cliente</td>
		<td>Mascota</td>
		<td>Fecha</td>
		<td>Comentario</td>
	</tr>
	<?php foreach ($params['citas'] as $cita) :?>
	<tr>
        <td><?php
			$usuarioID = $cita['usuario'];
			foreach ($params['usuarios'] as $usuario) {
				if ($usuario['ID'] == $usuarioID) {
					echo $usuario['nombre'];
					break;
				}
			}
	        ?>
        </td>
		<td><?php
			$mascotaID = $cita['mascota'];
			foreach ($params['mascotas'] as $mascota) {
				if ($mascota['ID'] == $mascotaID) {
					echo $mascota['nombreMascota'];
					break;
				}
			}
	        ?>
        </td>
		<td><?php echo $cita['fecha'] ?></td>
		<td><?php echo $cita['comentario'] ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
