<?php
session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include 'administrar_n.php';
$modulo_activo = "usuario";
controlar_session_abierta();
if (!controlar_permisos($_COOKIE['id_usuario'], "1")) {
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
            function preguntar_eliminar(id) {
                swal({
                    title: "Atenci\u00F3n!",
                    text: "Est\u00E1 a punto de eliminar registros relacionales. \u00bfSeguro que quiere continuar?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "S\u00ED, elim\u00EDnalo",
                    closeOnConfirm: false,
                    cancelButtonText: "No, cancelar",
                },
                        function () {
                            enviar(id);
                        });
            }
            function enviar(id) {
                window.location.href = "eliminar_registro.php?id=" + id;
            }
            function preguntar_especial(id, tipo) {
                if (tipo == 1) {
                    mensaje = "\u00bfQuiere quitarlo de los clientes especiales?";
                    mensaje_boton = "S\u00ED, quitarlo";
                } else if (tipo == 0) {
                    mensaje = "\u00bfQuiere agregarlo a los clientes especiales";
                    mensaje_boton = "S\u00ED, agregarlo";
                }
                swal({
                    title: "Atenci\u00F3n!",
                    text: mensaje,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: mensaje_boton,
                    closeOnConfirm: false,
                    cancelButtonText: "No, cancelar",
                },
                        function () {
                            enviar_especial(id, tipo);
                        });
            }
            function enviar_especial(id, tipo) {
                window.location.href = "usuario_especial.php?id=" + id + "&estado=" + tipo;
            }
            function destinatario_notificaciones(id, tipo) {
                if (tipo == 1) {
                    mensaje = "\u00bfQuiere quitarlo de los destinatarios de notificaciones?";
                    mensaje_boton = "S\u00ED, quitarlo";
                } else if (tipo == 0) {
                    mensaje = "\u00bfQuiere agregarlo a los destinatarios de notificaciones";
                    mensaje_boton = "S\u00ED, agregarlo";
                }
                swal({
                    title: "Atenci\u00F3n!",
                    text: mensaje,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: mensaje_boton,
                    closeOnConfirm: false,
                    cancelButtonText: "No, cancelar",
                },
                        function () {
                            enviar_destinatario_notif(id, tipo);
                        });
            }
            function enviar_destinatario_notif(id, tipo) {
                window.location.href = "notificacion_especial.php?id=" + id + "&estado=" + tipo;
            }
            function cambiar_clave(id) {
                swal({
                    title: "Modificaci\u00F3n de contrase\u00F1a",
                    text: "Ingrese la nueva contrase\u00F1a para el usuario seleccionado:",
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
                            var pass = inputValue;
                            enviar_clave(id, pass);
                        });
            }
            function enviar_clave(id, pass) {
                var conexion;
                if (window.XMLHttpRequest) {
                    conexion = new XMLHttpRequest();
                } else {
                    conexion = new ActivexObject("Microsoft.XMLHTTP");
                }
                conexion.onreadystatechange = function () {
                    if (conexion.readyState == 4 && conexion.status == 200) {
                        var respuesta = conexion.responseText;
                        if (respuesta == 1) {
                            var titulo = "Genial!";
                            var mensaje = "Almacenado exitosamente";
                            mostrar_mensaje('3', titulo, mensaje);
                        } else {
                            var titulo = "Hubo un problema!";
                            var mensaje = "Error al modificar la contrase\u00F1a";
                            mostrar_mensaje('0', titulo, mensaje);
                        }
                    }
                }
                conexion.open("GET", "modificar_clave.php?id=" + id + "&pass=" + pass, true);
                conexion.send();
            }
            $(document).ready(function () {
                $('#tabla').DataTable({
                    "order": [[1, "asc"], [0, "asc"]],
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "&Uacute;ltimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            });
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
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="card">
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <div class="icon-big icon-danger text-center">
                                                            <i class="fa fa-bar-chart" style="color: #EC3237"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <div class="numbers">
                                                            <p>Total</p>
                                                            <?php
                                                            if (isset($resultado)) {
                                                                echo mysql_num_rows($resultado);
                                                            } else {
                                                                echo "0";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="card">
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <div class="icon-big icon-warning text-center">
                                                            <i class="fa fa-arrow-up" style="color: green"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <div class="numbers">
                                                            <p>Activos</p>
                                                            <?php
                                                            if (isset($resultado)) {
                                                                echo obtener_usuarios_estado(1, $_POST['buscar']);
                                                            } else {
                                                                echo "0";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="card">
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <div class="icon-big icon-success text-center">
                                                            <i class="fa fa-arrow-down" style="color: red"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <div class="numbers">
                                                            <p>Inactivos</p>
                                                            <?php
                                                            if (isset($resultado)) {
                                                                echo obtener_usuarios_estado(0, $_POST['buscar']);
                                                            } else {
                                                                echo "0";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Administrar usuarios</h4>
                                    </div>
                                    <div class="content">
                                        <form action="administrar.php" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Buscar</label><br />
                                                    <?php
                                                    $valor = "";
                                                    if (isset($_POST['buscar'])) {
                                                        $valor = utf8_encode(trim($_POST['buscar']));
                                                    }
                                                    ?>
                                                    <input name="buscar" value="<?php echo $valor; ?>" type="text" class="form-control border-input"  />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <br />
                                                    <input type="hidden" name="enviar" />
                                                    <button type="submit" class="btn-default btn-danger btn-fill btn-wd">Buscar</button>
                                                    <br /><br />
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-md-12"><br /></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="tabla" class="display" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Apellido</th>
                                                            <th>Usuario</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (isset($resultado)) {
                                                            while ($fila = mysql_fetch_array($resultado)) {
                                                                ?>
                                                                <tr>
                                                                    <th><?php echo utf8_encode($fila['NOMBRES']); ?></th>
                                                                    <th><?php echo utf8_encode($fila['APELLIDO']); ?></th>
                                                                    <th><?php echo utf8_encode($fila['NOMBRE']); ?></th>
                                                                    <!--BOTON MODIFICAR USUARIO-->
                                                                    <th width="20%">
                                                                        <?php
                                                                        if (controlar_permisos($_COOKIE['id_usuario'], "2")) {
                                                                            ?>
                                                                            <a href="agregar.php?id=<?php echo $fila['ID']; ?>" title="Modificar información del usuario">
                                                                                <i class="fa fa-edit" style="color: #000"></i>
                                                                            </a>&nbsp;
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <!--BOTON CAMBIAR CONTRASENIA-->
                                                                        <?php
                                                                        if (controlar_permisos($_COOKIE['id_usuario'], "2")) {
                                                                            ?>
                                                                            <a href="#" onclick="cambiar_clave('<?php echo $fila['ID']; ?>')" title="Modificar contrase&ntilde;a del usuario">
                                                                                <i class="fa fa-asterisk" style="color: #000"></i>
                                                                            </a>&nbsp;
                                                                            <?php
                                                                        }
                                                                        if (controlar_permisos($_COOKIE['id_usuario'], "2")) {
                                                                            ?>
                                                                            <a href="cambio_estado.php?estado=<?php echo $fila['ACTIVO']; ?>&id=<?php echo $fila['ID']; ?>" title="Modificar estado del usuario">
                                                                                <?php
                                                                                if ($fila['ACTIVO'] == 1) {
                                                                                    ?>
                                                                                    <i class="fa fa-undo" style="color: green"></i>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <i class="fa fa-undo" style="color: red"></i>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </a>&nbsp;
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <!--BOTON PERMISOS DE ACCESO-->
                                                                        <?php 
                                                                        if (controlar_permisos($_COOKIE['id_usuario'], "5")) {
                                                                            ?>
                                                                            <a href="establecer_permisos.php?id=<?php echo $fila['ID']; ?>">
                                                                                <i class="fa fa-key" style="color: #F3BB45"></i>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <!--BOTON ELIMINAR USUARIO-->
                                                                        <?php
                                                                        if (controlar_permisos($_COOKIE['id_usuario'], "3")) {
                                                                            ?>
                                                                            <a href="#" onclick="preguntar_eliminar('<?php echo $fila['ID']; ?>')" title="Eliminar información del usuario">
                                                                                <i class="fa fa-close" style="color: red"></i>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
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
