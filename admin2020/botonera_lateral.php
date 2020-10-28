<div class="sidebar" data-background-color="black" style="background: #674651">
    <div class="sidebar-wrapper" style="background: #674651">
        <div class="logo">
            <a href="../portada/portada.php" class="simple-text">
                <img src="../img/logo.webp" class="img-responsive" />
            </a>
        </div>
        <ul class="nav">
            <?php
            $clase = "";
            if ($modulo_activo == "home") {
                $clase = ' class="active"';
            }
            ?>
            <li <?php echo $clase; ?>>
                <a href="../portada/portada.php" style="color: #deced3">
                    <i class="fa fa-home"></i>
                    <p>Home</p>
                </a>
            </li>
            <?php
            if (controlar_permisos($_COOKIE['id_usuario'], "1")) {
                $clase = "";
                if ($modulo_activo == "usuario") {
                    $clase = ' class="active"';
                }
                ?>
                <li <?php echo $clase; ?>>
                    <a href="../usuario/administrar.php" style="color: #deced3">
                        <i class="fa fa-users"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <?php
            }
            ?>
            <?php
            /*
            $clase = "";
            if ($modulo_activo == "linea") {
                $clase = ' class="active"';
            }
            ?>
            <li <?php echo $clase; ?>>
                <a href="../usuario/administrar.php" style="color: #deced3">
                    <i class="fab fa-houzz"></i>
                    <p>L&iacute;neas</p>
                </a>
            </li>
            <?php
            $clase = "";
            if ($modulo_activo == "vino") {
                $clase = ' class="active"';
            }
            ?>
            <li <?php echo $clase; ?>>
                <a href="../usuario/administrar.php" style="color: #deced3">
                    <i class="fas fa-wine-glass-alt"></i>
                    <p>Vinos</p>
                </a>
            </li>
            <?php
            $clase = "";
            if ($modulo_activo == "mensaje") {
                $clase = ' class="active"';
            }
            ?>
            <li <?php echo $clase; ?>>
                <a href="../usuario/administrar.php" style="color: #deced3">
                    <i class="fas fa-envelope"></i>
                    <p>Mensajes</p>
                </a>
            </li>
            <?php
            $clase = "";
            if ($modulo_activo == "lenguaje") {
                $clase = ' class="active"';
            }
            ?>
            <li <?php echo $clase; ?>>
                <a href="../usuario/administrar.php" style="color: #deced3">
                    <i class="fas fa-globe"></i>
                    <p>Lenguaje</p>
                </a>
            </li>
            <?php
            */
            ?>
            <li>
                <a href="../cerrar.php" style="color: #deced3">
                    <i class="fa fa-power-off"></i>
                    <p>Cerrar sesi&oacute;n</p>
                </a>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <hr />
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5" align="right">
                        <label style="color: #deced3"><b>Seguinos en:</b></label>
                    </div>
                    <div class="col-md-2" align="center">
                        <a style="color: #deced3" href="#" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                    <div class="col-md-2" align="center">
                        <a style="color: #deced3" href="#" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>