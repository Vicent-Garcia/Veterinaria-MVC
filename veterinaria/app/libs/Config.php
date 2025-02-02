<?php

//Esta clase almacena valores de configuración de la aplicación
class Config {
    public static $mvc_bd_hostname = "localhost"; //este es el servidor
    public static $mvc_bd_nombre = "veterinaria"; //el nombre de la base de datos que usa la aplicación
    public static $mvc_bd_usuario = "root"; //el usuario de la base de datos
    public static $mvc_bd_clave = ""; //he dejado la contraseña vacía
    public static $mvc_vis_css = "estilo.css"; //el estilo que utiliza la aplicación
    public static $vista = __DIR__ . '/../templates/inicio.php';//la vista principal
    public static $menu = __DIR__ . '/../templates/menuInvitado.php';//el menú inicial por defecto
}
?>