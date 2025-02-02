<?php

class Controller
{

    //Dependiendo del nivel de usuario se cargará uno de estos tres menús
    private function cargaMenu()
    {
        if ($_SESSION['nivel_usuario'] == 0) {
            return 'menuInvitado.php';
        } else if ($_SESSION['nivel_usuario'] == 1) {
            return 'menuUser.php';
        } else if ($_SESSION['nivel_usuario'] == 2) {
            return 'menuAdmin.php';
        }
    }


    public function home()
    {

        $params = array(
            'mensaje' => 'Bienvenido a Vidanimal',
            'mensaje2' => 'Puedes registrarte para empezar a gestionar tus citas',
            'fecha' => date('d-m-Y')
        );
        $menu = 'menuHome.php';

        if ($_SESSION['nivel_usuario'] > 0) {
            header("location:index.php?ctl=inicio");
        }
        require __DIR__ . '/../../web/templates/inicio.php';
    }
    public function inicio()
    {

        $params = array(
            'mensaje' => 'Bienvenido a nuestra clínica',
            'mensaje2' => '¿Cómo podemos ayudarte hoy?',
            'fecha' => date('d-m-Y')
        );
        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/inicio.php';
    }

    public function registro()
    {
        $menu = $this->cargaMenu();
        if ($_SESSION['nivel_usuario'] > 0) {
            header("location:index.php?ctl=inicio");
        }


        $params = array(
            'nombre' => '',
            'apellido' => '',
            'nombreUsuario' => '',
            'contrasenya' => '',
        );
        $errores = array();
        if (isset($_POST['bRegistro'])) { //si se hace click en el botón de registo recoge los campos introducidos 
            $nombre = recoge('nombre');
            $apellido = recoge('apellido');
            $nombreUsuario = recoge('nombreUsuario');
            $contrasenya = recoge('contrasenya');

            // Comprueba los campos del formulario      
            cTexto($nombre, "nombre", $errores);
            cTexto($apellido, "apellido", $errores);
            cUser($contrasenya, "contrasenya", $errores);
            cUser($nombreUsuario, "nombreUsuario", $errores);
            if (empty($errores)) {
                try {
                         
                    $m = new Veterinaria(); //new Veterinaria crea un objeto de clase Veterinaria.php, que extiende Modelo.php y conecta a la bd con pdo.
                    if($m->insertarUsuario($nombre, $apellido, $nombreUsuario, $contrasenya)){
  
                        header('Location: index.php?ctl=iniciarSesion');
                    } else {

                        $params = array(
                            'nombre' => $nombre,
                            'apellido' => $apellido,
                            'nombreUsuario' => $nombreUsuario,
                            'contrasenya' => $contrasenya
                        );

                        $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario.';
                    }

                    //estructura try-catch para manejar errores 
                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
                    header('Location: index.php?ctl=error');
                }
            } else {
                $params = array(
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'nombreUsuario' => $nombreUsuario,
                    'contrasenya' => $contrasenya
                );
                $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario.';
            }
        }


        require __DIR__ . '/../../web/templates/formRegistro.php';
    }

    public function subirFoto(){
        if (isset($_POST['subir'])) {
            //al hacer click en el botón subir se recoge el archivo subido por formulario
            $archivo = $_FILES['archivo']['name'];
            //nos aseguramos de que existe y no está vacío
            if (isset($archivo) && $archivo != "") {
               $tipo = $_FILES['archivo']['type'];
               $tamano = $_FILES['archivo']['size'];
               $temp = $_FILES['archivo']['tmp_name'];
               //Se ponen limitaciones de tipo y de tamaño. La función strpos busca el tipo de imagen.
              if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                 echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                 - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
              }
              else {
                 //Si la imagen es correcta en tamaño y tipo se intenta subir
                 if (move_uploaded_file($temp, 'img/'.$_SESSION['ID'].'.jpg')) {
                     //  se canmbian los permisos del archivo a 777 para poder modificarlo posteriormente. Esto es para que el usuario pueda cambiar su foto.
                     chmod('img/'.$_SESSION['ID'].'.jpg', 0777);

                     $menu = $this->cargaMenu();

                 }
                 else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                 }
               }
            }
         }
         require __DIR__ . '/../../web/templates/miPerfil.php';
    }

    public function subirFotoMascota(){
        if (isset($_POST['subirMascota'])) {
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES['archivo']['name'];

            if (isset($archivo) && $archivo != "") {
               $tipo = $_FILES['archivo']['type'];
               $tamano = $_FILES['archivo']['size'];
               $temp = $_FILES['archivo']['tmp_name'];
               $mascotaID = recoge('mascotaID');
               //se realizan las mismas comprobaciones que en subirFoto()
              if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                 echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                 - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
              }
              else {
                 if (move_uploaded_file($temp, 'img/mascotas/'.$mascotaID.'.jpg')) {
                     chmod('img/mascotas/'.$mascotaID.'.jpg', 0777);
                     $m = new Veterinaria();
                     $params = array(
                         'mascotas' => $m->listarMascotas($_SESSION['ID'])
                     );
                     $menu = $this->cargaMenu();

                 }
                 else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                 }
               }
            }
         }

        require __DIR__ . '/../../web/templates/mostrarMascotas.php';
    }

    public function error() //esta función llama a la vista de errores 
    {

        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/error.php';
    }

    public function iniciarSesion()
    {
        try {
            $params = array(
                'nombreUsuario' => '',
                'contrasenya' => ''
            );
            $menu = $this->cargaMenu();

            if ($_SESSION['nivel_usuario'] > 0) {
                header("location:index.php?ctl=inicio");
            }
            if (isset($_POST['bIniciarSesion'])) { // al hacer click en el botón de iniciar sesión
                $nombreUsuario = recoge('nombreUsuario');
                $contrasenya = recoge('contrasenya');
                // se comprueban campos del formulario
                if (cUser($nombreUsuario, "nombreUsuario", $params)) {                
                    $m = new Veterinaria();
                    if ($usuario = $m->consultarUsuario($nombreUsuario)) {
                        // se crea un objeto de tipo veterinaria, del modelo, y se realiza la consulta 
                        
                        if ($contrasenya == $usuario['contrasenya']) {
                            // se comprueba que la contraseña introducida encaje con la almacenada de ese usuario 
                            
                            $_SESSION['ID'] = $usuario['ID'];
                            $_SESSION['nombre'] = $usuario['nombre'];
                            $_SESSION['nivel_usuario'] = $usuario['nivel_usuario'];

                            // Guardamos la cookie para recordar sesión 30 días

                            setcookie("usuario_id", $usuario['ID'], time() + (86400 * 30), "/");
                            
                            
                            $menu = $this->cargaMenu();

                            if ($_SESSION['nivel_usuario'] > 0) {
                                header("location:index.php?ctl=inicio");
                            }
                        }
                        $params['mensaje'] = 'Contraseña incorrecta.';
                    } else {
                        $params = array(
                            'nombreUsuario' => $nombreUsuario,
                            'contrasenya' => $contrasenya
                        );
                        $params['mensaje'] = 'No se ha podido iniciar sesión. Revisa el formulario.';
                    }
                } else {
                    $params = array(
                        'nombreUsuario' => $nombreUsuario,
                        'contrasenya' => $contrasenya
                    );
                    $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario.';
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/formInicioSesion.php';
    }

    
    //función para cerrar sesión 
    public function salir()
    {
        session_destroy();

        header("location:index.php?ctl=home");
    }

    public function insertarMascota() //con esta función conectamos con la base de datos para almacenar mascotas. Solo el admin puede hacerlo
    {
        try {
            $params = array(
                'nombreMascota' => '',
                'familiar' => '',
                'edad' => '',
                'raza' => ''
            );
            $usuario = new Veterinaria(); // instancia del modelo
            $usuarios = $usuario->mostrarUsuarios(); // se obtienen los usuarios
            $errores = array();
            if (isset($_POST['bInsertarMascota'])) {  //el formulario tiene el botón de insertar mascota 
                $nombreMascota = recoge('nombreMascota');  //recoge los datos ingresados
                $familiar = recoge('familiar');
                $edad = recoge('edad');
                $raza = recoge('raza');
                // Comprobar campos formulario
                cTexto($nombreMascota, "nombreMascota", $errores);
                cNum($familiar, "familiar", $errores);
                cNum($edad, "edad", $errores);
                cTexto($raza, "raza", $errores);

                if (empty($errores)) {
                    // si no hay errores almacenados, creamos el objeto de modelo
                    $m = new Veterinaria();
                    if ($m->insertarMascota($nombreMascota, $familiar, $edad, $raza)) {
                        header('Location: index.php?ctl=registroExito');
                    } else {
                        $params = array(
                            'nombreMascota' => $nombreMascota,
                            'familiar' => $familiar,
                            'edad' => $edad,
                            'raza' => $raza
                        );
                        $params['mensaje'] = 'Error en el registro de la mascota';
                    }
                } else {
                    $params = array(
                        'nombreMascota' => $nombreMascota,
                        'familiar' => $familiar,
                        'edad' => $edad,
                        'raza' => $raza
                    );
                    $params['mensaje'] = 'Datos incorrectos';
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/formInsertarMascota.php';
    } 

    public function registroExito()//cuando el admin registra con éxito una mascota aparece el mensaje anunciando que ha funcionado
    {
        require __DIR__ . '/../../web/templates/registroExito.php';
    }

    public function mostrarMascotas()//función que muestra y lista las mascotas de los usuarios, conecta con la base de datos
    {
        try {
            $m = new Veterinaria();
            $params = array(
                'mascotas' => $m->listarMascotas($_SESSION['ID']),
            );
            if (!$params['mascotas'])
                $params['mensaje'] = "No hay mascotas que mostrar.";
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/mostrarMascotas.php';
    }

    public function misCitas(){ //esta función lista las citas del usuario, para ello tiene que llamar a la lista de mascotas también
       

        $m = new Veterinaria();
                     $params = array(
                         'mascotas' => $m->listarMascotas($_SESSION['ID']),
                         'citas' => $m->listarCitas($_SESSION['ID'])
                     );

        $menu = $this->cargaMenu();
        
        require __DIR__ . '/../../web/templates/misCitas.php';
    }

    public function pedirCita(){ //esta función le permite al usuario pedir cita
        $m = new Veterinaria();
        $params = array(
            'mascota' => '',
            'usuario' => '',
            'fecha' => '',
            'comentario' => '',
            'mascotas' => $m->listarMascotas($_SESSION['ID']),
            'citas' => $m->listarCitas($_SESSION['ID'])
        );
        $errores = array();
        if (isset($_POST['bPedirCita'])) { //al hacer click en el botón de pedir cita del formulario destinado a ello, en la vista misCitas.php

            //se recogen y se comprueban los campos del formulario
            $mascota = recoge('mascota');
            $usuario = $_SESSION['ID'];
            $fecha = recoge('fecha');
            $comentario = recoge('comentario');
            cNum($mascota, "mascota", $errores);
            unixFechaAAAAMMDD($fecha, "fecha", $errores);
            cTexto($comentario, "comentario", $errores);

            if ($cita = $m->insertarCita($usuario, $mascota, $fecha, $comentario)) {
                   
                }
            } else {
                $params['mensaje'] = 'Campos incorrectos, revise bien antes de solicitar la cita.';
            }
        
        $menu = $this->cargaMenu();
        
        require __DIR__ . '/../../web/templates/misCitas.php';
    }
    
    public function gestionarCitas(){  //esta vista permite al admin revisar las citas pendientes 

        $m = new Veterinaria();
                     $params = array(
                         'mascotas' => $m->listarTodasMascotas(),
                         'citas' => $m->listarTodasCitas(),
                         'usuarios' => $m->mostrarUsuarios(),
                     );

        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/gestionarCitas.php';
    }
    
    public function miPerfil(){

        $menu = $this->cargaMenu();
        
        require __DIR__ . '/../../web/templates/miPerfil.php';
    }

    public function sobreNosotros(){

        $menu = $this->cargaMenu();

        require __DIR__ . '/../../web/templates/sobreNosotros.php';
    }
}
