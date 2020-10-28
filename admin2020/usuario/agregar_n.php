<?php
include '../libreria/funciones.php';

$tipo_msj = "0";
$titulo_msj = "Hubo un problema";
$mensaje_msj = "";
if (isset($_POST['enviar'])) {
    $error = FALSE;
    // Control de nombre
    if (($mensaje_msj == "") && ($error == FALSE)) {
        $nombres = validar_variable($_POST['nombres'], 1);
        if (!$nombres) {
            $mensaje_msj = "No se ha especificado un nombre";
            $error = TRUE;
        }
    }
    // Control del apellido
    if (($mensaje_msj == "") && ($error == FALSE)) {
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
    //Control de contrasena
    if (isset($_POST['contrasenia'])) {
        if (($mensaje_msj == "") && ($error == FALSE)) {
            $contrasenia = validar_variable($_POST['contrasenia'], 1);
            if (!$contrasenia) {
                $mensaje_msj = "No se ha especificado una contrase\u00F1a";
                $error = TRUE;
            }
        }
    }
    // Control de activo
    $activo = 0;
    if (isset($_POST['activo'])) {
        $activo = 1;
    }
    if ($error == FALSE) {
        // Control de numero de id de usuario
        $id = "";
        if (isset($_POST['id'])) {
            $id = validar_variable($_POST['id'], 0);
            
            if (!$id) {
                die();
            }
        }
        $repetido = controlar_usuario_repetido("tb_usuario", "NOMBRE = '" . utf8_encode($nombre) . "'", $id);
        if ($repetido == TRUE) {
            if ((isset($_POST['id'])) && ($_POST['id'] <> "")) {
                modificar_informacion("tb_usuario", "NOMBRES = '" . utf8_decode($nombres) . "', APELLIDO='" . utf8_decode($apellido) . "', NOMBRE='" . utf8_decode($nombre) . "', ACTIVO='" . $activo . "'", "ID='" . $id . "'");
            } else {
                $contrasenia = preparar_contrasenia($contrasenia);
                almacenar_informacion("tb_usuario", "ID, NOMBRES, APELLIDO, NOMBRE, CONTRASENIA, ACTIVO, FECHA_CARGA, HORA_CARGA", "NULL, '" . utf8_decode($nombres) . "', '" . utf8_decode($apellido) . "', '" . utf8_decode($nombre) . "', '" . utf8_decode($contrasenia) . "', " . $activo . ", '" . date("Y/m/d") . "', '" . date("H:m:s") . "'");
            }
            // Se cargan los permisos de 'usuario' a un nuevo usuario del sistema
            $id = obtener_informacion("tb_usuario", "ID", "NOMBRE = '" . utf8_encode($nombre) . "'", "");
            $id = mysql_fetch_array($id);
            // Ver usuarios
            almacenar_informacion("tb_rel_perm", "ID, ID_USUARIO, ID_PERMISO, FECHA_CARGA, HORA_CARGA", "NULL, '" . $id['ID'] . "', '1', '" . date("Y/m/d") . "', '" . date("H:m:s") . "'");
            // Editar usuarios
            almacenar_informacion("tb_rel_perm", "ID, ID_USUARIO, ID_PERMISO, FECHA_CARGA, HORA_CARGA", "NULL, '" . $id['ID'] . "', '2', '" . date("Y/m/d") . "', '" . date("H:m:s") . "'");
            // Eliminar usuarios
            almacenar_informacion("tb_rel_perm", "ID, ID_USUARIO, ID_PERMISO, FECHA_CARGA, HORA_CARGA", "NULL, '" . $id['ID'] . "', '3', '" . date("Y/m/d") . "', '" . date("H:m:s") . "'");
            // Agregar usuarios
            almacenar_informacion("tb_rel_perm", "ID, ID_USUARIO, ID_PERMISO, FECHA_CARGA, HORA_CARGA", "NULL, '" . $id['ID'] . "', '4', '" . date("Y/m/d") . "', '" . date("H:m:s") . "'");
            // Permisos de usuarios
            almacenar_informacion("tb_rel_perm", "ID, ID_USUARIO, ID_PERMISO, FECHA_CARGA, HORA_CARGA", "NULL, '" . $id['ID'] . "', '5', '" . date("Y/m/d") . "', '" . date("H:m:s") . "'");
            
            $tipo_msj = "3";
            $titulo_msj = "Genial!";
            $mensaje_msj = "Almacenado exitosamente";
            $_POST['nombres'] = "";
            $_POST['apellido'] = "";
            $_POST['nombre'] = "";
            $_POST['contrasenia'] = "";
            $_POST['activo'] = "";
            $_POST['id'] = "";
        } else {
            $tipo_msj = "0";
            $titulo_msj = "Hubo un problema";
            $mensaje_msj = "El nombre de usuario ya existe";
        }
    }
}

if (isset($_POST['id'])) {
    if (trim($_POST['id']) <> "") {
        $_GET['id'] = trim($_POST['id']);
    }
}

if (isset($_GET['id'])) {
    $id = validar_variable($_GET['id'], 0);
    if (!$id) {
        die();
    } else {
        $resultado = obtener_informacion("tb_usuario", "ID, NOMBRES, APELLIDO, NOMBRE, CONTRASENIA, ACTIVO", "ID='" . $id . "'", "");
        $resultado = mysql_fetch_array($resultado);
    }
}

?>
