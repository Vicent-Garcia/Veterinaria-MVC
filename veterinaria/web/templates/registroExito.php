<!--Vista que aparece cuando el admin registra una mascota con éxito -->


<?php ob_start() ?>


<h3 class="text">¡Mascota registrada con Éxito!</h3>
<a HREF="index.php?ctl=insertarMascota"><button TYPE="button" class="" style="width: 150px;">INSERTAR OTRA MASCOTA</button></a>


<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>