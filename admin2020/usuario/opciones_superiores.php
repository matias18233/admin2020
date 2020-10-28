<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="../portada/agregar.php">
                        <i class="fa fa-user"></i>
                        <p><?php echo obtener_nombre_usuario(); ?></p>
                    </a>
                </li>
            </ul>
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (controlar_permisos($_COOKIE['id_usuario'], "4")) {
                    ?>
                    <li>
                        <a href="agregar.php">
                            <i class="fa fa-plus"></i>
                            <p>Agregar usuario</p>
                        </a>
                    </li>
                    <?php
                }
                if (controlar_permisos($_COOKIE['id_usuario'], "1")) {
                    ?>
                    <li>
                        <a href="administrar.php">
                            <i class="fa fa-bullhorn"></i>
                            <p>Administrar usuarios</p>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>