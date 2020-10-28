<?php
session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include 'agregar_n.php';
$modulo_activo = "usuario";
controlar_session_abierta();
if (isset($_GET['id'])) {
    if (!controlar_permisos($_COOKIE['id_usuario'], "2")) {
        header('Location: ../portada/portada.php');
    }
} else {
    if (!controlar_permisos($_COOKIE['id_usuario'], "4")) {
        header('Location: ../portada/portada.php');
    }
}
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
            function completar_datos(valor) {
                if (valor == 1) {
                    var contrasenia = document.getElementById("numero_cliente").value;
                    document.getElementById("contrasenia").value = contrasenia;
                } else if (valor == 2) {
                    var cuit = document.getElementById("cuit").value;
                    document.getElementById("nombre").value = cuit;
                }
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
                                        <h4 class="title">
                                            <?php
                                            $mensaje = "Agregar usuario";
                                            if (isset($_GET['id'])) {
                                                $mensaje = "Modificar usuario";
                                            }
                                            echo $mensaje;
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="content">
                                        <form action="agregar.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                        <?php
                                                        $valor = "";
                                                        if (isset($_POST['nombres'])) {
                                                            $valor = trim($_POST['nombres']);
                                                        } else if (isset($_GET['id'])) {
                                                            $valor = utf8_encode($resultado['NOMBRES']);
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control border-input" name="nombres" tabindex="1" maxlength="50" value="<?php echo $valor; ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Usuario</label>
                                                        <?php
                                                        $valor = "";
                                                        if (isset($_POST['nombre'])) {
                                                            $valor = trim($_POST['nombre']);
                                                        } else if (isset($_GET['id'])) {
                                                            $valor = utf8_encode($resultado['NOMBRE']);
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control border-input" name="nombre" tabindex="3" id="nombre" maxlength="50" value="<?php echo $valor; ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <?php
                                                        $valor = "";
                                                        if (isset($_POST['activo'])) {
                                                            $valor = "checked";
                                                        } else if (isset($_GET['id'])) {
                                                            if ($resultado['ACTIVO'] == 1) {
                                                                $valor = "checked";
                                                            }
                                                        }
                                                        ?>
                                                        <label><input type="checkbox" name="activo" value="" tabindex="5" <?php echo $valor; ?> />&nbsp;Activar registro</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Apellido</label>
                                                        <?php
                                                        $valor = "";
                                                        if (isset($_POST['apellido'])) {
                                                            $valor = trim($_POST['apellido']);
                                                        } else if (isset($_GET['id'])) {
                                                            $valor = utf8_encode($resultado['APELLIDO']);
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control border-input" name="apellido" tabindex="2" maxlength="50" value="<?php echo $valor; ?>" />
                                                    </div>
                                                    <?php
                                                    if (!isset($_GET['id'])) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label>Contrase&ntilde;a</label>
                                                            <?php
                                                            $valor = "";
                                                            if (isset($_POST['contrasenia'])) {
                                                                $valor = ($_POST['contrasenia']);
                                                            } else if (isset($_GET['id'])) {
                                                                $valor = utf8_encode($resultado['CONTRASENIA']);
                                                            }
                                                            ?>
                                                            <input type="password" class="form-control border-input" name="contrasenia" tabindex="4" id="contrasenia" maxlength="50" value="<?php echo $valor; ?>" />
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <br />
                                                <?php
                                                if (isset($_GET['id'])) {
                                                    ?>
                                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                                                    <?php
                                                }
                                                ?>
                                                <input type="hidden" name="enviar" />
                                                <button type="submit" class="btn-default btn-danger btn-fill">Guardar informaci&oacute;n</button>
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
