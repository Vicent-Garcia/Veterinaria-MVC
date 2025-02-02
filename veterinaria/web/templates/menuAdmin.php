<!--Este es el menú navbar del administrador -->
	<div class="Navbar">
		<h3 class="saludo"><a class="saludo" href="index.php?ctl=home">Bienvenido <?php echo $_SESSION['nombre']?></a></h3> 
		<a href="index.php?ctl=home"><button TYPE="button" class="bnav">INICIO</button></a>
		<a href="index.php?ctl=insertarMascota"><button TYPE="button" class="bnav">INSERTAR MASCOTA</button></a>
		<a href="index.php?ctl=gestionarCitas"><button TYPE="button" class="bnav">CITAS PENDIENTES</button></a>
		<a HREF="index.php?ctl=salir"><button TYPE="button" class="bnav">CERRAR SESIÓN</button></a>
	</div>
