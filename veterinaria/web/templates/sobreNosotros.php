<!--Vista con información de la clínica. Los invitados pueden acceder. -->


<?php ob_start() ?>

<div>
    <p class="sobreNosotros">En la clínica Vidanimal, nos apasiona el bienestar de los animales. Con años de experiencia y un equipo de profesionales dedicados, ofrecemos atención veterinaria de calidad para garantizar la salud y felicidad de tus mascotas. <br>

Nuestro compromiso es brindar un servicio cercano y personalizado, con instalaciones modernas y un enfoque integral en la prevención, diagnóstico y tratamiento de cualquier condición. Ya sea una consulta de rutina, vacunación o una atención especializada, estamos aquí para cuidar de quienes más quieres. <br>

¡Ven a conocernos y descubre cómo podemos ayudarte a darle a tu mascota la mejor calidad de vida! 🐶🐱💙</p>
</div>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>