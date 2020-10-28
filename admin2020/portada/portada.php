<?php
session_start();
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: ../cerrar.php");
}
include 'portada_n.php';
$modulo_activo = "home";
controlar_session_abierta();
?>
<!doctype html>
<html lang="es">
    <head>
        <?php
        include '../meta.php';
        ?>
        <style type="text/css">
        img {
            max-width: 100%
        }
        </style>
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
