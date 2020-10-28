<?php
session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include '../libreria/funciones.php';

function obtener_nombre_grupo($id) {
    $id = validar_variable($id, 0);
    if (!$id) {
        die();
    } else {
        $resultado = obtener_informacion("tb_permisos_grupo", "NOMBRE", "ID='" . $id . "'", "");
        $resultado = mysql_fetch_array($resultado);
        return $resultado['NOMBRE'];
    }
}

function comprobar_permiso_usuario($id, $permiso) {
    $id = validar_variable($id, 0);
    if (!$id) {
        die();
    } else {
        $permiso = validar_variable($permiso, 0);
        if (!$permiso) {
            die();
        } else {
            $resultado = obtener_informacion("tb_rel_perm", "ID", "(ID_USUARIO='" . $id . "') AND (ID_PERMISO='" . $permiso . "')", "");
            if (mysql_num_rows($resultado) > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}

if (isset($_GET['id'])) {
    $id = validar_variable($_GET['id'], 0);
    if (!$id) {
        die();
    } else {
        $permisos = obtener_informacion("tb_permisos", "ID, NOMBRE, DESCRIPCION, GRUPO", "ACTIVO='1'", "GRUPO ASC, NOMBRE ASC");
        $grupo = 0;
        while ($fila = mysql_fetch_array($permisos)) {
            if ($grupo <> $fila['GRUPO']) {
                $grupo = $fila['GRUPO'];
                ?>
                <div class="row">
                    <div class="col-md-12">M&oacute;dulo: <?php echo utf8_encode(obtener_nombre_grupo($grupo)); ?></div>
                </div>
                <?php
            }
            ?>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-11">
                    <?php
                    $checked = "";
                    if (comprobar_permiso_usuario($id, $fila['ID']) == TRUE) {
                        $checked = "checked";
                    }
                    ?>
                    <input type="checkbox" name="permisos_usuario[]" id="<?php echo $fila['ID']; ?>" value="<?php echo $fila['ID']; ?>" <?php echo $checked; ?> />
                    &nbsp;
                    <label for="<?php echo $fila['ID']; ?>"><?php echo utf8_encode($fila['NOMBRE']); ?> <i class="fa fa-info" title="<?php echo utf8_encode($fila['DESCRIPCION']); ?>"></i></label>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="text-center">
            <input type="hidden" name="enviar" />
            <input type="hidden" name="contrasenia" />
        </div>
        <div class="clearfix"></div>
        <?php
    }
}
?>