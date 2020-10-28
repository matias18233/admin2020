<?php
session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include 'agregar_n.php';
$modulo_activo = "home";
controlar_session_abierta();
?>
<!doctype html>
<html lang="es">
    <head>
        <?php
        include '../meta.php';
        ?>
        <link href="../croppic/css/main_users.css" rel="stylesheet">
        <script>
            function actualizar_departamento() {
                var provincia = document.getElementById("provincia").value;
                var conexion;
                document.getElementById("departamento").innerHTML = "<div align='center'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></div>";
                if (window.XMLHttpRequest) {
                    conexion = new XMLHttpRequest();
                } else {
                    conexion = new ActivexObject("Microsoft.XMLHTTP");
                }
                conexion.onreadystatechange = function () {
                    if (conexion.readyState == 4 && conexion.status == 200) {
                        document.getElementById("departamento").innerHTML = conexion.responseText;
                    }
                }
                conexion.open("GET", "../libreria/funciones_ajax.php?contenido=3&provincia=" + provincia, true);
                conexion.send();
            }
        </script>
    </head>
    <body>
        <div class="wrapper">
            <?php
            include '../botonera_lateral.php';
            ?>
            <div class="main-panel">
                <?php
                include 'opciones_superiores.php';
                ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-10 col-md-12 col-lg-offset-1">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Modificar usuario</h4>
                                    </div>
                                    <div class="content">
                                        <form action="agregar.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                        <?php
                                                        $valor = "";
                                                        if (isset($resultado)) {
                                                            $valor = utf8_encode(trim($resultado['NOMBRES']));
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control border-input" name="nombres" maxlength="50" value="<?php echo $valor; ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Apellido</label>
                                                        <?php
                                                        $valor = "";
                                                        if (isset($resultado)) {
                                                            $valor = utf8_encode(trim($resultado['APELLIDO']));
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control border-input" name="apellido" maxlength="50" value="<?php echo $valor; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Usuario</label>
                                                        <?php
                                                        $valor = "";
                                                        if (isset($resultado)) {
                                                            $valor = utf8_encode(trim($resultado['NOMBRE']));
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control border-input" name="nombre" tabindex="3" id="nombre" maxlength="50" value="<?php echo $valor; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <br />
                                                <input type="hidden" name="enviar" />
                                                <button type="submit" class="btn-default btn-danger btn-fill btn-wd">Guardar informaci&oacute;n</button>
                                                <br /><br />
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include '../pie.php';
                ?>
            </div>
        </div>
    </body>
</html>
<script>
    mostrar_mensaje("<?php echo $tipo_msj; ?>", "<?php echo $titulo_msj; ?>", "<?php echo $mensaje_msj; ?>");
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Instrucciones para crear mapa de Google Maps</h5>
            </div>
            <div class="modal-body">
                <p style="font-size:16px"><b>Crear mapa</b></p>
                <p>1 - Inicie sesi&oacute;n con una cuenta de Google en la siguiente web: <a href="https://www.google.com/maps/d/" target="_blank">Mis mapas</a></p>
                <p>2 - Cree un nuevo mapa y ubiquelo en el &aacute;rea donde se ubica su empresa.</p>
                <p>3 - Presione el botón "<b>Agregar marcador</b>" (<i class="fa fa-map-marker" aria-hidden="true"></i>) y haga clic justo en la direcci&oacute;n que necesita marcar. Coloque un nombre y presione "<b>Guardar</b>".</p><br />
                <p style="font-size:16px"><b>Hacer p&uacute;blico el mapa</b></p>
                <p>1 - Dentro del recuadro ubicado en la parte superior izquierda: haga clic en la opci&oacute;n "<b>Compartir</b>". Agregue un t&iacute;tulo y descripci&oacute;n si lo desea; posteriormente, clic en "<b>Ok</b>".</p>
                <p>2 - En la secci&oacute;n "<b>Usuarios con acceso</b>" haga clic en "<b>Cambiar...</b>" y seleccione "<b>Activado: p&uacute;blico en la Web</b>", luego haga clic en "<b>Guardar</b>" y posteriormente en "<b>Listo</b>". </p><br />
                <p style="font-size:16px"><b>Obtener coordenadas</b></p>
                <p>1 - Dentro del recuadro ubicado en la parte superior izquierda: haga clic en el bot&oacute;n de los 'tres puntos' (en la parte de arriba).</p>
                <p>2 - Haga clic en la opci&oacute;n "<b>Insertar en mi sitio</b>"</p>
                <p>3 - Copiar el contenido y pegarlo en el campo correspondiente, de los datos de su perf&iacute;l de usuario. Tendr&aacute; un aspecto similar al siguiente:</p>
                <p><img src="../img/iframe_ejemplo.PNG" width="100%" /></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>