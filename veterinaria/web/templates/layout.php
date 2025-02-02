<!--Esta es la vista del layout base de la aplicación. Usando la variable contenido y la función de búfer podemos traer contenido a esta página  -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Clínica Veterinaria</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="<?php echo Config::$mvc_vis_css ?>" />
</head>

<body>
	<div class="titulo">
		<h1><b>Clínica Veterinaria Vidanimal</b></h1>	
	</div>
	
	<?php	
	if (!isset($menu)) {
	    $menu = 'menuInvitado.php';
	}
	include $menu;
    ?>

	<div id="contenido">
		<?php echo $contenido ?>
	</div>
	
	<div class="pie">
		<p>&copy; 2024 Vidanimal. Todos los derechos reservados.</p>
	</div>
</body>

</html>