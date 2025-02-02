<?php

//esta clase hereda de Modelo, y por tanto de PDO. Es la clase que usamos para interactuar con la base de datos.
//para esta aplicación se utiliza sobre todo para hacer SELECT e INSERT INTO, es decir, para consultar/listar y para hacer registros.
//las tres tablas que se usan en la base de datos son Usuario, Mascota y Cita, y por eso las funciones de esta clase interactuan con las tres.
class Veterinaria extends Modelo {
    
    public function consultarUsuario($nombreUsuario) {
        $consulta = "SELECT * FROM veterinaria.usuario WHERE nombreUsuario=:nombreUsuario ";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombreUsuario', $nombreUsuario);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function mostrarUsuarios(){
        $consulta = "SELECT * FROM veterinaria.usuario";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insertarUsuario($nombre, $apellido, $nombreUsuario, $contrasenya) {
        $consulta = "INSERT INTO veterinaria.usuario (nombre, apellido, nombreUsuario, contrasenya) VALUES (:nombre, :apellido, :nombreUsuario, :contrasenya)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $nombre);
        $result->bindParam(':apellido', $apellido);
        $result->bindParam(':nombreUsuario', $nombreUsuario);
        $result->bindParam(':contrasenya', $contrasenya);
        $result->execute();
        return $result; 
    }

    public function insertarMascota($nombreMascota, $familiar, $edad, $raza) {
        $consulta = "INSERT INTO veterinaria.mascota (nombreMascota, familiar, edad, raza) VALUES (:nombreMascota, :familiar, :edad, :raza)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombreMascota', $nombreMascota);
        $result->bindParam(':familiar', $familiar);
        $result->bindParam(':edad', $edad);
        $result->bindParam(':raza', $raza);
        $result->execute();        
        return $result;
    }
    
    public function listarTodasMascotas() {
        $consulta = "SELECT * FROM veterinaria.mascota ";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarMascotas($familiar) {
        $consulta = "SELECT * FROM veterinaria.mascota WHERE familiar=:familiar ";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':familiar', $familiar);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insertarCita($usuario, $mascota, $fecha, $comentario) {
        $consulta = "INSERT INTO veterinaria.cita (usuario, mascota, fecha, comentario) VALUES (:usuario, :mascota, :fecha, :comentario)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':usuario', $usuario);
        $result->bindParam(':mascota', $mascota);
        $result->bindParam(':fecha', $fecha);
        $result->bindParam(':comentario', $comentario);
        $result->execute();        
        return $result;
    }

    public function listarCitas($usuario){
        $consulta = "SELECT * FROM veterinaria.cita WHERE usuario=:usuario ";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':usuario', $usuario);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);

    }

    public function listarTodasCitas(){
        $consulta = "SELECT * FROM veterinaria.cita WHERE fecha >= CURDATE()";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);

    }
}