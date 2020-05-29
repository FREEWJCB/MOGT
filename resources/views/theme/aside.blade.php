<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset("assets/theme/img/index.png")}}" class="img-circle" alt="Imagen de usuario" />
            </div>
            <div class="pull-left info">
                <p>Hola {{ Auth::user()->name }}!!!</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="/">
                    <i class="fa fa-dashboard"></i> <span>Inicio</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Salud del estudiante</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('alergia.index') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Alergia</a>
                    </li>
                    <li><a href="{{ route('tipoAlergia.index') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Tipo de alergia</a>
                    </li>
                    <li><a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Discapacidad</a>
                    </li>
                    <li><a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Tipo de discapacidad</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Representante</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Trabajo</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Trabajadores</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Prefesor</a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Empleados</a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Cargo</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Geografía</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Estado</a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Municipio</a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-angle-double-right"></i>
                        Parroquia</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('usuario.index') }}">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Usuarios</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
