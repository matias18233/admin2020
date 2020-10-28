<?php
session_start();
include 'index_n.php';
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../admin_imagen/sistema/icon_76.png" />
        <link rel="icon" type="image/png" sizes="96x96" href="../admin_imagen/sistema/icon_96.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Passionate Wine | Administrador de contenido</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/paper-dashboard_login.css" rel="stylesheet"/>
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css' />
        <link href="css/themify-icons.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <script src="js/jquery-1.12.3.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/paper-dashboard.js"></script>
        <script src="js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
        <script src="js/funciones.js"></script>
        <style>
        /*
        html,body {
            margin:0px;
            height:100%;
            background: url('./img/login.jpg');
            background-size:100% 100%;
        }
        */
        </style>
    </head>
    <body style="background: #F4F3EF">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="margin-top:16%">
                        <form method="post" action="index.php">
                            <div class="card" data-background="color" style="background: #674651">
                                <div class="header">
                                    <img src="img/logo.webp" class="img-responsive"/>
                                </div>
                                <div class="content">
                                    <div class="form-group">
                                        <label style="color: #deced3">Usuario</label>
                                        <?php
                                        $valor = "";
                                        if (isset($_POST['usuario'])) {
                                            $valor = trim($_POST['usuario']);
                                        }
                                        ?>
                                        <input type="text" class="form-control input-no-border" name="usuario" value="<?php echo $valor; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #deced3">Contrase&ntilde;a</label>
                                        <?php
                                        $valor = "";
                                        if (isset($_POST['contrasenia'])) {
                                            $valor = trim($_POST['contrasenia']);
                                        }
                                        ?>
                                        <input type="password" class="form-control input-no-border" name="contrasenia" value="<?php echo $valor; ?>" />
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <input type="hidden" name="enviar" />
                                    <button type="submit" class="btn-default btn-fill btn-danger">Iniciar sesi&oacute;n</button><br />
                                    <div class="row text-center">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <hr />
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <label style="color: #deced3"><b>Seguinos en:</b></label>&nbsp;&nbsp;
                                            <a style="color: #deced3" href="#" target="_blank">
                                                <i class="fa fa-facebook-official" aria-hidden="true"></i>&nbsp;Facebook
                                            </a>&nbsp;&nbsp;
                                            <a style="color: #deced3" href="#" target="_blank">
                                                <i class="fa fa-instagram" aria-hidden="true"></i>&nbsp;Instagram
                                            </a>
                                        </div><br /><br />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    mostrar_mensaje("<?php echo $tipo_msj; ?>", "<?php echo $titulo_msj; ?>", "<?php echo $mensaje_msj; ?>");
</script>