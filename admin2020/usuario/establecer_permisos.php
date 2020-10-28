<?php
session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include 'establecer_permisos_n.php';
$modulo_activo = "usuario";
controlar_session_abierta();
if (!controlar_permisos($_COOKIE['id_usuario'], "5")) {
    header('Location: ../portada/portada.php');
}
?>
<!doctype html>
<html lang="es">
    <head>
        <?php
        include '../meta.php';
        ?>
        <script type="text/javascript">
            function actualizar_permisos() {
                var conexion;
                document.getElementById("respuesta").innerHTML = "<div align='center'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></div>";
                var id = document.getElementById("usuario").value;
                if (window.XMLHttpRequest) {
                    conexion = new XMLHttpRequest();
                } else {
                    conexion = new ActivexObject("Microsoft.XMLHTTP");
                }
                conexion.onreadystatechange = function () {
                    if (conexion.readyState == 4 && conexion.status == 200) {
                        document.getElementById("respuesta").innerHTML = conexion.responseText;
                    }
                }
                conexion.open("GET", "establecer_permisos_ajax.php?id=" + id, true);
                conexion.send();
            }
            function agregar_elemento() {
                var id_permiso = document.getElementById("permisos").value;
                var control = true;
                $("#permisos_usuario option").each(function () {
                    if (control == true) {
                        if (id_permiso == $(this).attr('value')) {
                            control = false;
                        }
                    }
                });
                if (control == true) {
                    var texto_permiso = $("#permisos option:selected").text();
                    $('#permisos_usuario').append('<option value="' + id_permiso + '">' + texto_permiso + '</option>');
                }
            }
            function quitar_elemento() {
                var id_permiso = document.getElementById("permisos_usuario").value;
                $("#permisos_usuario").find("option[value='" + id_permiso + "']").remove();
            }
            $("#enviar_frm").click(function () {
                alert("Handler for .click() called.");
            });
            function enviar() {
                swal({
                    title: "Atenci\u00F3n!",
                    text: "Ingrese su contrase\u00F1a para continuar:",
                    type: "input",
                    inputType: "password",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Contrase\u00F1a"
                },
                        function (inputValue) {
                            if (inputValue === false)
                                return false;

                            if (inputValue === "") {
                                swal.showInputError("No se ha ingresado la contrase\u00F1a!");
                                return false
                            }
                            document.formulario.contrasenia.value = inputValue;
                            document.formulario.submit();
                        });
            }
        </script>
    </head>
    <body onload="javascript: actualizar_permisos();">
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
                            <div class="col-lg-2 col-md-2"></div>
                            <div class="col-lg-8 col-md-8">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Establecer permisos</h4>
                                    </div>
                                    <div class="content">
                                        <form name="formulario" action="establecer_permisos.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Usuario</label>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-8">
                                                                <select name="usuario" id="usuario" class="form-control border-input">
                                                                    <?php
                                                                    while ($fila = mysql_fetch_array($usuarios)) {
                                                                        ?>
                                                                        <option value="<?php echo $fila['ID']; ?>"><?php echo utf8_encode($fila['NOMBRE']); ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="respuesta"></div>
                                        </form>
                                        <div class="text-center">
                                            <br />
                                            <button onclick="javascript:enviar()" class="btn-default btn-fill btn-danger">Guardar informaci&oacute;n</button>
                                            <br /><br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2"></div>
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