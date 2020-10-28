<?php

include 'libreria/funciones.php';

$tipo_msj = "0";
$titulo_msj = "Hubo un problema";
$mensaje_msj = "";
if (isset($_POST['enviar'])) {
    $error = FALSE;
    // Control de nombre de usuario
    if (($mensaje_msj == "") && ($error == FALSE)) {
        $usuario = validar_variable($_POST['usuario'], 1);
        if (!$usuario) {
            $mensaje_msj = "Se ha ingresado un nombre de usuario no v\u00E1lido";
            $error = TRUE;
        }
    }
    // Control de contrasena de usuario
    if (($mensaje_msj == "") && ($error == FALSE)) {
        $contrasenia = validar_variable($_POST['contrasenia'], 1);
        if (!$contrasenia) {
            $mensaje_msj = "Se ha ingresado una contrase\u00F1a no v\u00E1lida";
            $error = TRUE;
        }
    }
    // Comienza el analisis de la informacion (usuario y contrasena)
    if ($error == FALSE) {
        $resultado = obtener_informacion("tb_usuario", "ID, CONTRASENIA", "NOMBRE = '" . $usuario . "'", "");
        $resultado = mysql_fetch_array($resultado);
        if (comparar_contrasenias($contrasenia, $resultado['CONTRASENIA'])) {
            almacenar_informacion("tb_ingreso", "ID, ID_USUARIO, FECHA_INGRESO, HORA_INGRESO", "NULL, '" . $resultado['ID'] . "', '" . date("Y-m-d") . "', '" . date("H:m:s") . "'");
            setcookie("id_usuario", $resultado['ID'], time() + 3600, "/", "");
            header('Location: portada/portada.php');
        } else {
            $tipo_msj = "2";
            $titulo_msj = "Hubo un problema";
            $mensaje_msj = "La informaci\u00F3n ingresada no coincide con ning\u00FAn usuario";
        }
    }
}
?>
