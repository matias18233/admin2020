<?php

session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include '../libreria/funciones.php';
controlar_session_abierta();

if (isset($_GET['id'])) {
    $id = validar_variable($_GET['id'], 0);
    if (!$id) {
        die();
    } else {
        eliminar_registro("tb_usuario", "ID='" . $id . "'");
    }
}
header("Location:administrar.php");
?>