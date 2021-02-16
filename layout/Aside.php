<aside  class="app-sidebar">
    <div style="text-align: center;" ><img class="app-sidebar__user-avatar r" src="./librerias/img/login3.png" width="100" height="100" alt="User Image">
    </div>
    <ul class="app-menu" style="margin-top: 10px;">
        <?php
        if ($_SESSION["usuario"][0][3] == "ADMINISTRADOR"):
            ?>
            <li><a  class="app-menu__item <?php if (basename($_SERVER["REQUEST_URI"]) == 'PagUsuarios.php') echo "active"; ?>" href="./PagUsuarios.php"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span></a></li>

            <?php
        endif;
        ?>

        <?php
        if ($_SESSION["usuario"][0][3] == "ADMINISTRADOR"):
            ?>
            <li><a  class="app-menu__item <?php if (basename($_SERVER["REQUEST_URI"]) == 'PagProductos.php') echo "active"; ?>" href="./PagProductos.php"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Productos</span></a></li>
            <?php
        endif;
        ?>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-fax"></i><span class="app-menu__label">Ventas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item  <?php if (basename($_SERVER["REQUEST_URI"]) == 'PagVenta.php') echo "active"; ?>" href="PagVenta.php"  ><i class="icon fa fa-circle-o"></i>Nueva Venta</a></li>
                <li><a class="treeview-item  <?php if (basename($_SERVER["REQUEST_URI"]) == 'PagMisVentas.php') echo "active"; ?>" href="PagMisVentas.php"  ><i class="icon fa fa-circle-o"></i>Mis Ventas</a></li>

            </ul>
        </li>
        <?php
        if ($_SESSION["usuario"][0][3] == "ADMINISTRADOR"):
            ?>
            <li><a  class="app-menu__item <?php if (basename($_SERVER["REQUEST_URI"]) == 'PagKardex.php') echo "active"; ?>" href="./PagKardex.php"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Reporte</span></a></li>

            <?php
        endif;
        ?>
    </ul>
</aside>