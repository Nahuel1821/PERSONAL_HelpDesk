<header class="site-header">
    <div class="container-fluid">

        <div class="site-header-content">

            <a href="http://localhost:90/PERSONAL_HelpDesk/view/Home/" class="site-logo">
                <img class="hidden-md-down" src="https://www.ffyb.uba.ar/wp-content/uploads/2020/03/ubalogo.jpg" alt="">
                <img class="hidden-md-down" src="https://nanobiotec.conicet.gov.ar/wp-content/uploads/sites/33/2018/11/logo-ffyb-300x300.png" alt="">
                <img class="hidden-lg-up" src="https://nanobiotec.conicet.gov.ar/wp-content/uploads/sites/33/2018/11/logo-ffyb-300x300.png" alt="">
            </a>

            <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
                <span>toggle menu</span>
            </button>

            <button class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </button>
            <div class="site-header-shown">
                <div class="dropdown user-menu">
                    <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown dropdown-typical">
                            <a href="" class="dropdown-toggle no-arr">
                                <img src="../../public/<?php echo $_SESSION["rol_id"] ?>.jpg" alt="">
                                <span class="lblcontactonomx"><?php echo $_SESSION["usu_nom"] ?> <?php echo $_SESSION["usu_ape"] ?></span>
                            </a>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                        <a class="dropdown-item" href="../MntPerfil/"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
                        <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
                    </div>
                </div>
            </div>

            <div class="mobile-menu-right-overlay"></div>

            <input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>"><!-- ID del Usuario-->
            <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>"><!-- Rol del Usuario-->
            
        </div>

    </div>
</header>