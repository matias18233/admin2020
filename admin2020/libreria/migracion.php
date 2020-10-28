<?php
include "funciones.php";

$resultado = obtener_informacion("table1", "*", "", "");

while ($fila = mysql_fetch_array($resultado)) {
    $fila["COL 1"] = addslashes($fila["COL 1"]);
    $fila["COL 1"] = trim($fila["COL 1"]);
    // ANALISIS DE REPRESENTACION
    $representacion = obtener_informacion("tb_representacion", "ID", "NOMBRE = '" . $fila["COL 1"] . "'", "");
    $representacion = mysql_fetch_array($representacion);
    if ($representacion['ID'] == null) {
        // echo "No existe (" . $fila["COL 1"] . ")<br />";
        almacenar_informacion("tb_representacion", "ID, NOMBRE, URL_WEB, ACTIVO, SUBTITULO, DESCRIPCION, NOMBRE_ARCHIVO, POSICION, MOSTRAR_EN_WEB, FECHA_CARGA, HORA_CARGA", "NULL, '" . $fila["COL 1"] . "', '', 1, '', '', '', 0, 1, '" . date("Y-m-d") . "', '" . date("H:m:s") . "'");
        echo "Almacenado (representacion)";
    } else {
        // ANALISIS DE SUBPRODUCTO
        $fila["COL 2"] = addslashes($fila["COL 2"]);
        $fila["COL 2"] = trim($fila["COL 2"]);
        $subproducto = obtener_informacion("tb_subproducto", "ID", "NOMBRE = '" . $fila["COL 2"] . "'", "");
        $subproducto = mysql_fetch_array($subproducto);
        if ($subproducto['ID'] == null) {
            // echo "No existe (" . $fila["COL 2"] . ")";
            almacenar_informacion("tb_subproducto", "ID, ID_REPRESENTACION, NOMBRE, ACTIVO, NOMBRE_ARCHIVO, POSICION, FECHA_CARGA, HORA_CARGA", "NULL, " . $representacion['ID'] . ", '" . $fila["COL 2"] . "', 1, '', 0, '" . date("Y-m-d") . "', '" . date("H:m:s") . "'");
            echo "Almacenado (subproducto)";
        } else {
            // ANALISIS DE PRODUCTO
            $fila["COL 3"] = addslashes($fila["COL 3"]);
            $fila["COL 3"] = trim($fila["COL 3"]);
            $producto = obtener_informacion("tb_producto", "ID", "NOMBRE = '" . $fila["COL 3"] . "'", "");
            $producto = mysql_fetch_array($producto);
            if ($producto['ID'] == null) {
                echo "No existe (" . $fila["COL 3"] . ")";
                almacenar_informacion("tb_producto", "ID, ID_SUBPRODUCTO, NOMBRE, ACTIVO, POSICION, FECHA_CARGA, HORA_CARGA", "NULL, " . $subproducto['ID'] . ", '" . $fila["COL 3"] . "', 1, 0, '" . date("Y-m-d") . "', '" . date("H:m:s") . "'");
                echo "Almacenado (producto)";
            } else {
                // ANALISIS DE ITEM
                $fila["COL 4"] = addslashes($fila["COL 4"]);
                $fila["COL 4"] = trim($fila["COL 4"]);
                $item = obtener_informacion("tb_item", "ID", "NOMBRE = '" . $fila["COL 4"] . "'", "");
                $item = mysql_fetch_array($item);
                if ($item['ID'] == null) {
                    echo "No existe (" . $fila["COL 4"] . ")";
                    almacenar_informacion("tb_item", "ID, ID_PRODUCTO, NOMBRE, ACTIVO, NOMBRE_ARCHIVO, DETALLE, DESCUENTO, FORMA_PAGO, FECHA_CARGA, HORA_CARGA", "NULL, " . $producto['ID'] . ", '" . $fila["COL 4"] . "', 1, '', '', '', '', '" . date("Y-m-d") . "', '" . date("H:m:s") . "'");
                    echo "Almacenado (item)";
                }
            }
        }
    }
    echo "<br />";
}

?>