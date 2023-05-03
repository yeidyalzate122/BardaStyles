    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png" alt="User Image">
            <div>
                <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombre']; ?></p>
                <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol']; ?></p>
            </div>
        </div>
        <ul class="app-menu">
            <?php if (!empty($_SESSION['permisos'][1]['r'])) { ?>
                <li>
                    <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                        <i class="app-menu__icon fa fa-dashboard"></i>
                        <span class="app-menu__label">Inicio</span>
                    </a>
                </li>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][2]['r']) || !empty($_SESSION['permisos'][9]['r']) || !empty($_SESSION['permisos'][12]['r']) || !empty($_SESSION['permisos'][3]['r']) || !empty($_SESSION['permisos'][11]['r'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                        <span class="app-menu__label">Gestionar usuarios</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (!empty($_SESSION['permisos'][9]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles del sistema</a></li>
                        <?php } ?>
                        <?php if (!empty($_SESSION['permisos'][12]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/empleados"><i class="icon fa fa-circle-o"></i>Empleados</a></li>
                        <?php } ?>
                        <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/cliente"><i class="icon fa fa-circle-o"></i>Clientes</a></li>
                        <?php } ?>
                        <?php if (!empty($_SESSION['permisos'][11]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/acudiente"><i class="icon fa fa-circle-o"></i>Acudientes</a></li>
                        <?php } ?>

                    </ul>
                </li>
            <?php } ?>


            <?php if (!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][10]['r']) || !empty($_SESSION['permisos'][13]['r']) || !empty($_SESSION['permisos'][6]['r'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-archive" aria-hidden="true"></i>
                        <span class="app-menu__label">Productos y servicios</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">

                        <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/categorias"><i class="icon fa fa-circle-o"></i> Categorías</a></li>
                        <?php } ?>

                        <?php if (!empty($_SESSION['permisos'][13]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/servicios"><i class="icon fa fa-circle-o"></i>Configuracíon de los servicios</a></li>
                        <?php } ?>

                        <?php if (!empty($_SESSION['permisos'][10]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/producto "><i class="icon fa fa-circle-o"></i>Inventario de productos</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>


            <?php if (!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][10]['r']) || !empty($_SESSION['permisos'][13]['r']) || !empty($_SESSION['permisos'][6]['r'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">

                        <i class="fa-light fa-calendar-circle-plus" aria-hidden="true"></i>
                        <span class="app-menu__label">Gestión de citas</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                     
                        <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/agendarCitas"><i class="icon fa fa-circle-o"></i>Citas</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][7]['r'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                        <span class="app-menu__label">Cliente</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/CitasCliente"><i class="icon fa fa-circle-o"></i>Mis citas</a></li>

                    </ul>
                </li>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][8]['r'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                        <span class="app-menu__label">Empleado</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/CitasBarberos"><i class="icon fa fa-circle-o"></i>Mis citas</a></li>

                    </ul>
                </li>

            <?php } ?>

            <li>
               
            </li>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                    <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                    <span class="app-menu__label">Cerrar sesión</span>
                </a>
            </li>
        </ul>
    </aside>