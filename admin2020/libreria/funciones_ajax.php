<?php
include 'funciones.php';

if (isset($_GET['contenido'])) {
    if (trim($_GET['contenido']) == "1") {
        traer_subproductos(trim($_GET['representacion']), trim($_GET['nombre']), trim($_GET['seleccionar']));
    } else if (trim($_GET['contenido']) == "2") {
        traer_productos(trim($_GET['representacion']), trim($_GET['nombre']));
    } else if (trim($_GET['contenido']) == "3") {
        actualizar_departamento(trim($_GET['provincia']));
    } else if (trim($_GET['contenido']) == "4") {
        actualizar_cantidad(trim($_GET['producto']), trim($_GET['cantidad']));
    } else if(trim($_GET['contenido']) == "5"){
        mostrar_modal_producto(trim($_GET['producto']));
    }
}

function actualizar_cantidad($producto, $cantidad) {
    eliminar_registro("tb_carrito_compra", "(ID_USUARIO = " . $_COOKIE['id_usuario'] . ") AND (ID_PRODUCTO = " . $producto . ")");
    almacenar_informacion("tb_carrito_compra", "ID, ID_USUARIO, ID_PRODUCTO, CANTIDAD, FECHA_CARGA, HORA_CARGA", "NULL, " . $_COOKIE['id_usuario'] . ", " . $producto . ", " . $cantidad . ", '" . date("Y/m/d") . "', '" . date("H:m:s") . "'");
}

function actualizar_departamento($provincia) {
    $departamento = obtener_informacion("tb_departamento", "ID, NOMBRE", "ID_PROVINCIA = " . $provincia, "NOMBRE ASC");
    ?>
    <select name="departamento" class="form-control border-input">
        <option value="0">Seleccionar...</option>
        <?php
        while ($fila = mysql_fetch_array($departamento)) {
            ?>
            <option value="<?php echo $fila['ID']; ?>"><?php echo utf8_encode($fila['NOMBRE']); ?></option>
            <?php
        }
        ?>
    </select>
    <?php
}

function traer_subproductos($representacion, $nombre, $seleccionar) {
    $sentencia = obtener_informacion("tb_subproducto", "ID, NOMBRE", "ID_REPRESENTACION='" . $representacion . "' AND ACTIVO='1' AND (NOMBRE<>'[sin_valor]')", "NOMBRE ASC");
    $respuesta = "<select id='" . $nombre . "' name='" . $nombre . "' onchange='cambiar_2()' class='form-control border-input'>";
    $respuesta = $respuesta . "<option value=''>Seleccionar...</option>";
    while ($fila = mysql_fetch_array($sentencia)) {
        $selected = "";
        if ($seleccionar == $fila['ID']) {
            $selected = " selected";
        }
        $respuesta = $respuesta . "<option value='" . $fila['ID'] . "' " . $selected . ">" . utf8_encode($fila['NOMBRE']) . "</option>";
    }
    $respuesta = $respuesta . "</select>";
    echo $respuesta;
}

function traer_productos($subproducto, $nombre) {
    $sentencia = obtener_informacion("tb_producto", "ID, NOMBRE", "ID_SUBPRODUCTO='" . $subproducto . "' AND ACTIVO='1' AND (NOMBRE<>'[sin_valor]')", "NOMBRE ASC");
    $respuesta = "<select id='" . $nombre . "' name='" . $nombre . "' class='form-control border-input'>";
    $respuesta = $respuesta . "<option value=''>Seleccionar...</option>";
    while ($fila = mysql_fetch_array($sentencia)) {
        $respuesta = $respuesta . "<option value='" . $fila['ID'] . "'>" . utf8_encode($fila['NOMBRE']) . "</option>";
    }
    $respuesta = $respuesta . "</select>";
    echo $respuesta;
}

function mostrar_modal_producto($producto) {
    $resultado = obtener_informacion("tb_item", "ID_PRODUCTO, NOMBRE, DETALLE, DESCUENTO, FORMA_PAGO", "ID = " . $producto, "");
    $resultado = mysql_fetch_array($resultado);
    $producto = obtener_informacion("tb_producto", "ID_SUBPRODUCTO, NOMBRE", "ID = " . $resultado['ID_PRODUCTO'], "");
    $producto = mysql_fetch_array($producto);
    //---------------------------------------
    $subproducto = obtener_informacion("tb_subproducto", "ID_REPRESENTACION, NOMBRE", "ID = " . $producto['ID_SUBPRODUCTO'], "");
    $subproducto = mysql_fetch_array($subproducto);
    //---------------------------------------
    $representacion = obtener_informacion("tb_representacion", "NOMBRE", "ID = " . $subproducto['ID_REPRESENTACION'], "");
    $representacion = mysql_fetch_array($representacion);
    $representacion = $representacion['NOMBRE'];
    $subproducto = $subproducto['NOMBRE'];
    $producto = $producto['NOMBRE'];
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Detalles: <?php echo utf8_encode($resultado['NOMBRE']); ?></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p><b>Representaci&oacute;n:</b> <?php echo utf8_encode($representacion); ?></p>
                <p><b>Subproducto:</b> <?php echo utf8_encode($subproducto); ?></p>
                <p><b>Producto:</b> <?php echo utf8_encode($producto); ?></p>
                <p><b>Detalles:</b> <?php echo utf8_encode($resultado['DETALLE']); ?></p>
                <p><b>Presentaci&oacute;n:</b> <?php echo utf8_encode($resultado['DESCUENTO']); ?></p>
                <p><b>Oferta:</b> <?php echo utf8_encode($resultado['FORMA_PAGO']); ?></p>
            </div>
        </div>
    </div>
    <?php
}
?>