<?php

include '../libreria/funciones.php';

$tipo_msj = "0";
$titulo_msj = "Hubo un problema";
$mensaje_msj = "";
if (isset($_POST['enviar'])) {
    $error = FALSE;
    if (($mensaje_msj == "") && ($error == FALSE)) {//Control de nombre de usuario
        $nombres = validar_variable($_POST['nombres'], 1);
        if (!$nombres) {
            $mensaje_msj = "No se ha especificado un nombre";
            $error = TRUE;
        }
    }
    if (($mensaje_msj == "") && ($error == FALSE)) {//Control de apellido de usuario
        $apellido = validar_variable($_POST['apellido'], 1);
        if ((!$apellido) && ($apellido == "")) {
            $mensaje_msj = "No se ha especificado un apellido";
            $error = TRUE;
        }
    }
    //Control de usuario
    if (($mensaje_msj == "") && ($error == FALSE)) {
        $nombre = validar_variable($_POST['nombre'], 1);
        if (!$nombre) {
            $mensaje_msj = "No se ha especificado un usuario";
            $error = TRUE;
        }
    }
    if ($error == FALSE) {
        $id = validar_variable($_COOKIE['id_usuario'], 0);
        // Comprobamos que no exista el nombre de usuario, a menos que sea el mismo usuario
        $repetido = controlar_usuario_repetido("tb_usuario", "NOMBRE = '" . utf8_encode($nombre) . "'", $id);
        if ($repetido == TRUE) {
            if (!$id) {
                die();
            } else {
                modificar_informacion("tb_usuario", "NOMBRES = '" . utf8_decode($nombres) . "', APELLIDO='" . utf8_decode($apellido) . "', NOMBRE='" . utf8_decode($nombre) . "'", "ID='" . $id . "'");
                
                $tipo_msj = "3";
                $titulo_msj = "Genial!";
                $mensaje_msj = "Almacenado exitosamente";
            }
        } else {
            $tipo_msj = "0";
            $titulo_msj = "Hubo un problema";
            $mensaje_msj = "El nombre de usuario ya existe";
        }
    }
}

if (isset($_COOKIE['id_usuario'])) {
    $id = validar_variable($_COOKIE['id_usuario'], 0);
    if (!$id) {
        die();
    } else {
        $resultado = obtener_informacion("tb_usuario", "ID, NOMBRES, APELLIDO, NOMBRE", "ID='" . $id . "'", "");
        $resultado = mysql_fetch_array($resultado);
    }
}

?>
