<?php

$servidor = "localhost";
$usuario = "root";
$contrasenia = "";
$base_datos = "asia";
@mysql_connect($servidor, $usuario, $contrasenia) or die("<b>ERROR:</b> Problemas al establecer conexi&oacuten con MySQL");
mysql_select_db($base_datos) or die("<b>ERROR:</b> Problemas al establecer conexi&oacuten con la base de datos");
?>
