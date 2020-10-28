<?php

include '../libreria/funciones.php';

$usuarios = NULL;
if (((isset($_GET['id'])) && (trim($_GET['id']) <> "")) || (isset($_POST['usuario'])) && (trim($_POST['usuario']))) {
    if (isset($_GET['id'])) {
        $id = trim($_GET['id']);
    } else if (isset($_POST['usuario'])) {
        $id = trim($_POST['usuario']);
    }
    $id = validar_variable($id, 0);
    if (!$id) {
        die();
    } else {
        $usuarios = obtener_informacion("tb_usuario", "ID, NOMBRE", "(ACTIVO=1) AND (ID = '" . $id . "')", "");
    }
}

$tipo_msj = "0";
$titulo_msj = "Hubo un problema";
$mensaje_msj = "";
if (isset($_POST['enviar'])) {
    $id_usuario = validar_variable($_COOKIE['id_usuario'], 0);
    if (!$id_usuario) {
        die();
    } else {
        $contrasenia = validar_variable($_POST['contrasenia'], 1);
        if (!$contrasenia) {
            die();
        } else {
            $resultado = obtener_informacion("tb_usuario", "CONTRASENIA", "ID='" . $id_usuario . "'", "");
            if (mysql_num_rows($resultado) > 0) {
                $resultado = mysql_fetch_array($resultado);
                if (comparar_contrasenias($contrasenia, $resultado['CONTRASENIA'])) {
                    if (isset($_POST['usuario'])) {
                        $usuario = validar_variable($_POST['usuario'], 0);
                        if (!$usuario) {
                            die();
                        } else {
                            eliminar_registro("tb_rel_perm", "(ID_USUARIO='" . $usuario . "')");
                            @$permisos = $_POST['permisos_usuario'];
                            if (count($permisos) > 0) {
                                foreach ($permisos as $fila) {
                                    $fila = validar_variable($fila, 0);
                                    if (!$fila) {
                                        die();
                                    } else {
                                        almacenar_informacion("tb_rel_perm", "ID, ID_USUARIO, ID_PERMISO, FECHA_CARGA, HORA_CARGA", "NULL, '" . $usuario . "', '" . $fila . "', '" . date("Y-m-d") . "', '" . date("H:m:s") . "'");
                                    }
                                }
                                $tipo_msj = "3";
                                $titulo_msj = "Genial!";
                                $mensaje_msj = "Almacenado exitosamente";
                            }
                        }
                    }
                } else {
                    $mensaje_msj = "Contrase\u00F1a incorrecta";
                }
            } else {
                $mensaje_msj = "Usuario incorrecto";
            }
        }
    }
}
?>