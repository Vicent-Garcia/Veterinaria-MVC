<!--Vista de errores. Utilizando el búfer podemos enviar el contenido de esta vista a layout.php  -->

<?php ob_start();
if (isset($params['mensaje'])) {
?>
<b><span style="color: rgba(200, 119, 119, 1);">
<?php
    echo $params['mensaje'];
    echo "</span></b>";
}
?>

<div>
		<h3>Se ha producido un error</h3>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>