<?php

set_time_limit(0);
include 'funciones.php';

$usuarios = obtener_informacion("tb_usuario", "ID", "ID IN (SELECT DISTINCT(ID_USUARIO) FROM tb_rel_perm WHERE (ID_PERMISO='22') OR (ID_PERMISO='24'))", "");

if (mysql_num_rows($usuarios) > 0) {
    while ($fila = mysql_fetch_array($usuarios)) {
        almacenar_informacion("tb_rel_perm", "ID, ID_USUARIO, ID_PERMISO, FECHA_CARGA, HORA_CARGA", "NULL, " . $fila['ID'] . ", 28, '" . date("Y/m/d") . "', '" . date("H:m:s") . "'");
    }
} else {
    echo "No existen registros para procesar<br />";
}
?>