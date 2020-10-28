<?php
include '../libreria/funciones.php';

if (isset($_POST['buscar'])) {
    $filtro = validar_variable($_POST['buscar'], 1);
    if ((!$filtro) && ($filtro <> "")) {
        die();
    } else {
        $filtro = "(NOMBRES LIKE '%" . $filtro . "%') || (APELLIDO LIKE '%" . $filtro . "%') || (NOMBRE LIKE '%" . $filtro . "%')";
        $resultado = obtener_informacion("tb_usuario", "*", $filtro, "");
    }
} else {
    $resultado = obtener_informacion("tb_usuario", "*", "", "");
    $_POST['buscar'] = "";
}

function obtener_usuarios_estado($estado, $filtro) {
    $filtro = validar_variable($filtro, 1);
    if ((!$filtro) && ($filtro <> 0)) {
        die();
    } else {
        $filtro = " AND ((NOMBRES LIKE '%" . $filtro . "%') || (APELLIDO LIKE '%" . $filtro . "%') || (NOMBRE LIKE '%" . $filtro . "%'))";
        $activo = obtener_informacion("tb_usuario", "COUNT(ACTIVO) AS ACTIVO", "(ACTIVO=" . $estado . ")" . $filtro, "");
        $activo = mysql_fetch_array($activo);
        return $activo['ACTIVO'];
    }
}

?>