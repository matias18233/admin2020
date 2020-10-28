<?php

include '../libreria/funciones.php';

$id = validar_variable($_COOKIE['id_usuario'], 0);
if(!$id){
    die();
}

?>