<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trimble Perú | @yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ url('/home') }}" class="site_title"><i class="fa fa-battery-full"></i> <span>Trimble Perú</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="{{ asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bienvenido,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-cubes"></i> Ingresos <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a>Retorno<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/ingreso/listar/retorno') }}">Ver retornos</a></li>
                                            <li><a href="{{ url('/ingreso/retorno') }}">Ingresar retorno</a></li>
                                        </ul>
                                    </li>
                                    <li><a>Compra<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/ingreso/listar/compra') }}">Ver compras</a></li>
                                            <li><a href="{{ url('/ingreso/compra') }}">Ingresar compra</a></li>
                                        </ul>
                                    </li>
                                    <li><a>Reutilización<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/ingreso/listar/reutilizacion') }}">Ver reutilizaciones</a></li>
                                            <li><a href="{{ url('/ingreso/reutilizacion') }}">Ingresar reutilizacion</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-rocket"></i> Salidas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a>Venta<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/salida/listar/venta') }}">Ver ventas</a></li>
                                            <li><a href="{{ url('/salida/venta') }}">Ingresar venta</a></li>
                                        </ul>
                                    </li>
                                    <li><a>Alquiler<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/salida/listar/alquiler') }}">Ver alquileres</a></li>
                                            <li><a href="{{ url('/salida/alquiler') }}">Ingresar alquiler</a></li>
                                        </ul>
                                    </li>
                                    <li><a>Por baja<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/salida/baja') }}">Ingresar baja</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-user"></i> Clientes y Proveedores <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a>Clientes<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/clientes') }}">Ver clientes</a></li>
                                            <li><a href="{{ url('/clientes/tipos') }}">Tipos de cliente</a></li>
                                        </ul>
                                    </li>
                                    <li><a>Proveedores<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/proveedores') }}">Ver proveedores</a></li>
                                            <li><a href="{{ url('/proveedores/tipos') }}">Tipos de proveedor</a></li>
                                        </ul>

                                    </li>

                                </ul>
                            </li>

                            <li><a><i class="fa fa-edit"></i> Productos y paquetes <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a>Productos<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('/product/category/index') }}">Categorías</a></li>
                                            <li><a href="{{ url('product/subcategory/index') }}">Subcategorías</a></li>
                                            <li><a href="{{ url('product/brand/index') }}">Marcas</a></li>
                                            <li><a href="{{ url('/product/model/index') }}">Modelos</a></li>
                                            <li><a href="{{ url('product/product/index') }}">Productos</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ url('/package/index') }}">Paquetes</a></li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-bar-chart-o"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="chartjs.html">Chart JS</a></li>
                                    <li><a href="chartjs2.html">Chart JS2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="menu_section">
                        <h3>Más</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-bug"></i> Reportar error</a></li>
                            <li><a href="{{ url('/logout') }}">
                                    <i class="fa fa-plug"></i> Desconectar
                            </a></li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/img.jpg') }}" alt="">{{ Auth::user()->name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;">  Profile</a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">Help</a>
                                </li>
                                <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                        <span class="image">
                                          <img src="{{ asset('images/img.jpg') }}" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                        <span class="image">
                                          <img src="{{ asset('images/img.jpg') }}" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                        <span class="image">
                                          <img src="{{ asset('images/img.jpg') }}" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                        <span class="image">
                                          <img src="{{ asset('images/img.jpg') }}" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>@yield('title')</h3>
                    </div>

                    @yield('title-right')
                </div>

                <div class="clearfix"></div>

                @yield('content')
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Trimble Perú - Developed by Enigmatic Team
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>