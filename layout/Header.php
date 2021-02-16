
<header  class="app-header">
    <a class="app-header__logo" th:href="#">Licoreria</a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">

        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i> 
                Usuario : <?= $_SESSION["usuario"][0][1] ?></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="./controlador/ControlUsuario.php?accion=cerrar"><i class="fa fa-sign-out fa-lg"></i> Cerrar Sesion</a>
                </li>
            </ul>
        </li>
    </ul>
</header>