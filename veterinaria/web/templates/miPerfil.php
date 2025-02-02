<!-- Perfil de usuario, desde aquí se puede cambiar la foto de perfil con un formulario-->

<?php ob_start() ?>

<h2>Aquí puedes cambiar tu foto de perfil:</h2>
<br>
<form action="index.php?ctl=subirFoto" method="POST" enctype="multipart/form-data">
				<input name="archivo" id="archivo" type="file"/>
				<input type="submit" name="subir" value="Subir imagen"/>
			</form>


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>