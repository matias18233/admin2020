<?php

session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include '../libreria/funciones.php';
controlar_session_abierta();

if (isset($_GET['estado'])) {
    $estado = validar_variable($_GET['estado'], 0);
    if ((!$estado) && $estado <> 0) {
        die();
    } else {
        if ($estado == 1) {
            $estado = 0;
        } else {
            $estado = 1;
        }
        $id = validar_variable($_GET['id'], 0);
        if (!$id) {
            die();
        } else {
            modificar_informacion("tb_usuario", "ACTIVO='" . $estado . "'", "ID='" . $id . "'");
        }
    }
}
header('Location: administrar.php');
?>