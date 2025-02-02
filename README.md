# Veterinaria-MVC
Proyecto de app web para una clínica veterinaria.

Para este proyecto se ha creado una aplicación web sobre una clínica veterinaria. 
 Se han establecido tres niveles de acceso: invitado, usuario y administrador.
Para el rol invitado, por defecto, al acceder a la aplicación, se muestra una página de bienvenida, información acerca de la clínica y la posibilidad de darse de alta como usuario, indicando: nombre, apellido, nombre de usuario y contraseña, para poder solicitar asistencia médica para sus mascotas. Se le asignará un avatar por defecto que podrá cambiar más adelante desde su perfil.
En cuanto al rol de usuario, una vez se logguea en la aplicación, se le ofrece la posibilidad de visualizar las mascotas que tiene dadas de alta, consultar el histórico de sus citas, pedir una cita nueva indicando cuál de sus mascotas necesita el servicio, la fecha cercana que se desea realizar la visita y la posibilidad de añadir un comentario ofreciendo alguna explicación, acceder a su perfil personal, donde puede cambiar la imagen de avatar y cerrar la sesión.  
Finalmente, para el rol de administrador, que deberá darse de alta a través de un SGBD (por seguridad), se le permite dar de alta las mascotas de los usuarios que acudan a la clínica, indicando: nombre, raza, edad y familiar asociado, además de poder consultar aquellas citas que tenga pendientes. 
