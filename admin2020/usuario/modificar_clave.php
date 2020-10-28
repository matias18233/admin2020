<?php
session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include '../libreria/funciones.php';

$respuesta = 0;
if (isset($_GET['id'])) {
    $id = validar_variable($_GET['id'], 0);
    if (!$id) {
        die();
    } else {
        if (isset($_GET['pass'])) {
            $pass = validar_variable($_GET['pass'], 1);
            if (!$pass) {
                die();
            } else {
                $pass = preparar_contrasenia($pass);
                modificar_informacion("tb_usuario", "CONTRASENIA = '" . $pass . "'", "ID = " . $id);
                $respuesta = 1;
            }
        }
    }
}
echo $respuesta;
?>