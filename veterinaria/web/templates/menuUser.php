<!--Este es el menú navbar de usuario. Tiene la funcionalidad de recibir un saludo personalizado,
además, aparece la foto de perfil predeterminada o la que haya subido el usuario  -->


<div class="Navbar">
<h3 class="saludo"><a class="saludo" href="index.php?ctl=home">Bienvenido <?php echo $_SESSION['nombre']?> </a></h3>
<?php 
$rutaImagen = 'img/' . $_SESSION['ID'] . '.jpg';
if (file_exists($rutaImagen)) {
	echo '<a href="index.php?ctl=miPerfil"><img src="' . $rutaImagen . '" style="height: 70px; border-radius: 20px" class="fotoSaludo" alt="Foto de usuario"></a>';
} else {
	echo '<a href="index.php?ctl=miPerfil"> <img src="img/avatar.jpg" style="height: 70px; border-radius: 20px" class="fotoSaludo" alt="Foto de usuario"></a>';
}
?>
	<a href="index.php?ctl=home"><button TYPE="button" class="bnav">INICIO</button></a>
	<a href="index.php?ctl=mostrarMascotas"><button TYPE="button" class="bnav">MIS MASCOTAS</button></a>
	<a href="index.php?ctl=misCitas"><button TYPE="button" class="bnav">MIS CITAS</button></a>
	<a href="index.php?ctl=miPerfil"><button TYPE="button" class="bnav">MI PERFIL</button></a>
	<a href="index.php?ctl=salir"><button TYPE="button" class="bnav">CERRAR SESIÓN</button></a>
</div>