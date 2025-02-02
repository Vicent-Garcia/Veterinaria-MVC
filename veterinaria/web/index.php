<?php 

// Se requieren los diferentes directorios necesarios para la aplicación

require_once __DIR__ . '/../app/libs/Config.php';
require_once __DIR__ . '/../app/controlador/Controller.php';
require_once __DIR__ . '/../app/libs/bGeneral.php';
require_once __DIR__ . '/../app/libs/bSeguridad.php';
require_once __DIR__ . '/../app/modelo/Modelo.php';
require_once __DIR__ . '/../app/modelo/Veterinaria.php';


session_start(); //Se inicia la sesión. Si no hay una sesión de nivel de usuario creada, se utiliza el nivel 0, de invitado. 

if (!isset($_SESSION['nivel_usuario'])) {
    $_SESSION['nivel_usuario'] = 0;
}

if (isset($_COOKIE['usuario_id'])) { //se comprueba si existe una cookie para el usuario 
    $_SESSION['ID'] = $_COOKIE['usuario_id'];
}


// MAPA DE RUTAS: donde se especifican las rutas de la aplicación. 
//cada ruta tiene el controlador encargado de la acción, la acción que representa el método que se ejecuta
// y el nivel de usuario requerido para acceder a la ruta 

$map = array(
    'home' => array('controller' => 'Controller', 'action' => 'home', 'nivel_usuario' => 0),
    'inicio' => array('controller' => 'Controller', 'action' => 'inicio', 'nivel_usuario' => 0),
    'registro' => array('controller' => 'Controller', 'action' => 'registro', 'nivel_usuario' => 0),
    'subirFoto' => array('controller' => 'Controller', 'action' => 'subirFoto', 'nivel_usuario' => 1),
    'error' => array('controller' => 'Controller', 'action' => 'error', 'nivel_usuario' => 0),
    'iniciarSesion' => array('controller' => 'Controller', 'action' => 'iniciarSesion', 'nivel_usuario' => 0),
    'sobreNosotros' => array('controller' => 'Controller', 'action' => 'sobreNosotros', 'nivel_usuario' => 0),
    'salir' => array('controller' => 'Controller', 'action' => 'salir', 'nivel_usuario' => 1),
    'insertarMascota' => array('controller' => 'Controller', 'action' => 'insertarMascota', 'nivel_usuario' => 2),
    'registroExito' => array('controller' => 'Controller', 'action' => 'registroExito', 'nivel_usuario' => 2),
    'mostrarMascotas' => array('controller' => 'Controller', 'action' => 'mostrarMascotas', 'nivel_usuario' => 1),
    'subirFotoMascota' => array('controller' => 'Controller', 'action' => 'subirFotoMascota', 'nivel_usuario' => 1),
    'misCitas' => array('controller' => 'Controller', 'action' => 'misCitas', 'nivel_usuario' => 1),
    'pedirCita' => array('controller' => 'Controller', 'action' => 'pedirCita', 'nivel_usuario' => 1),
    'miPerfil' => array('controller' => 'Controller', 'action' => 'miPerfil', 'nivel_usuario' => 1),
    'gestionarCitas' => array('controller' => 'Controller', 'action' => 'gestionarCitas', 'nivel_usuario' => 2)
    

);

// procesador de la ruta determina qué controlador y qué acción ejecutar dependiendo del ctl que recibe en la URL
if (isset($_GET['ctl'])) { //si está definido ctl
    if (isset($map[$_GET['ctl']])) { //si existe en el mapa
        $ruta = $_GET['ctl']; ///se guarda
    } else { //si no existe se marca que no se ha encontrado 

        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
            $_GET['ctl'] . '</p></body></html>';
        exit;
    }
} else { //si no está definido se lleva a home por defecto
    $ruta = 'home';
}

$controlador = $map[$ruta]; 

// este fragmento sirve para ejecutar el método adecuado según la ruta
if (method_exists($controlador['controller'], $controlador['action'])) { //se comprueba que el método(acción) exista
    if ($controlador['nivel_usuario'] <= $_SESSION['nivel_usuario']) { //se asaegura de que el nivel del usuario es compatible y le permite acceder
        call_user_func(array(
            new $controlador['controller'], //crea la instancia del controlador y llama al método
            $controlador['action']
        ));
    }else{
        call_user_func(array( // si no tiene el nivel, va a inicio
            new $controlador['controller'],
            'inicio'
        )); 
    }
} else {  //marca que no lo ha encontrado 
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controller'] .
        '->' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
    echo ("entrarErrorInicio");
}