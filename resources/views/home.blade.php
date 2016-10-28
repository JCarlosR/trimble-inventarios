@extends('layouts.panel')

@section('title', 'Bienvenido')

@section('title-right')
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

            <form class="form-inline" action="{{ url('/producto') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="product_name" class="form-control" placeholder="Buscar producto ...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go</button>
                    </span>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h1>
                        TRIMBLE PERÚ CORPORATION SAC
                    </h1>
                    <h3>
                        Sistema de Gestión de Inventarios
                    </h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>Ingreso de productos y paquetes</p>
                                    <button class="btn btn-primary btn-block" data-info="Ingresos">
                                        Ingresos
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>Salida de productos y paquetes</p>
                                    <button class="btn btn-primary btn-block" data-info="Salidas">
                                        Salidas
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>Cadena de valor</p>
                                    <button class="btn btn-primary btn-block" data-info="Cadena">
                                        Clientes y Proveedores
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>Gestión de bienes</p>
                                    <button class="btn btn-primary btn-block" data-info="Bienes">
                                        Productos y Paquetes
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>Gestión de almacenes y oficinas</p>
                                    <button class="btn btn-primary btn-block" data-info="Ubicaciones">
                                        Ubicaciones
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>Conceptos por caja chica</p>
                                    <button class="btn btn-primary btn-block" data-info="Caja">
                                        Caja chica
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{ asset('images/bg.jpg') }}" alt="Fondo de bienvenida">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalIngresos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ingresos</h4>
                </div>
                <div class="modal-body">
                    <p>La sección de ingresos hace referencia a todo tipo de ingreso de bienes a la empresa.</p>
                    <p>Esto significa, que se consideran como ingresos los siguientes casos:</p>
                    <ul>
                        <li>
                            <strong>Compra:</strong> Cuando se adquieren nuevos bienes y estos ingresan a la empresa por primera vez.
                        </li>
                        <li>
                            <strong>Retorno:</strong> Cuando un producto o paquete que habían sido alquilados regresan a la empresa.
                        </li>
                        <li>
                            <strong>Reutilización:</strong> Cuando un producto o paquete es dado de baja, generalmente algunas partes aún pueden continuar en funcionamiento. Estas nuevas partes se deben registrar luego de dar de baja lo que ya no se utilizará.
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modalSalidas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Salidas</h4>
                </div>
                <div class="modal-body">
                    <p>La sección de salidas hace referencia a todo tipo de salida de bienes de la empresa.</p>
                    <p>Esto significa, que se consideran como salidas los siguientes casos:</p>
                    <ul>
                        <li>
                            <strong>Venta:</strong> Cuando se venden productos o paquetes a un cliente determinado.
                        </li>
                        <li>
                            <strong>Alquiler:</strong> Cuando un conjunto de productos y/o paquetes son alquilados.
                        </li>
                        <li>
                            <strong>Por baja:</strong> Cuando un producto o paquete es dado de baja. Generalmente algunas partes van a ser registradas como un ingreso por reutilización.
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modalCadena">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cadena de valor</h4>
                </div>
                <div class="modal-body">
                    <p>La cadena de valor hace referencia a los clientes y proveedores de la empresa.</p>
                    <p>Por lo tanto aquí encontramos:</p>
                    <ul>
                        <li>
                            <strong>Clientes:</strong> Gestión de los datos de clientes, y gestión de tipos de cliente.
                        </li>
                        <li>
                            <strong>Proveedores:</strong> Gestión de los datos de proveedores, y gestión de tipos de proveedor.
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modalBienes">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Productos y Paquetes</h4>
                </div>
                <div class="modal-body">
                    <p>Este módulo permite gestionar todo lo referente a productos y paquetes.</p>
                    <p>De esta forma los bienes en la empresa se gestionan en base a:</p>
                    <ul>
                        <li>
                            <strong>Productos:</strong> Este apartado permite registrar los productos que maneja la empresa. Es posible gestionar categorías de productos, subcategorías, marcas y modelos.
                        </li>
                        <li>
                            <strong>Paquetes:</strong> Es posible juntar un conjunto de bienes, a fin de venderlos a todos como un paquete compacto, o facilitar su alquiler en grupo.
                        </li>
                    </ul>
                    <p><strong>Nota:</strong> En la sección de productos, se definen los tipos de productos que se van a comercializar, pero este apartado no guarda relación con el stock ni las existencias, ya que éstas se van a determinar en función a los ingresos y salidas registrados.</p>
                    <p>La sección de paquetes, sin embargo, si se relaciona con bienes existentes en la empresa. Por eso aquí, es posible formar paquetes seleccionando existencias de productos.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modalUbicaciones">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubicaciones</h4>
                </div>
                <div class="modal-body">
                    <p>La sección de ubicaciones hace referencia a todo tipo de ubicaciones y contenedores.</p>
                    <p>Aquí encontramos los siguientes conceptos:</p>
                    <ul>
                        <li>
                            <strong>Locales:</strong> Se permite registrar tanto almacenes como oficinas. Estos se consideran de forma general como locales, por ser la ubicación más genérica.
                        </li>
                        <li>
                            <strong>Anaqueles:</strong> Todo local, sea almacén u oficina, comprende anaqueles.
                        </li>
                        <li>
                            <strong>Niveles:</strong> Cada anaquel comprende de 1 a N niveles.
                        </li>
                        <li>
                            <strong>Cajas:</strong> En los niveles de cada anaquel nos encontramos con cajas, que son contenedores de productos. De esta forma, cada caja puede contener productos y paquetes.
                        </li>
                    </ul>
                    <p><strong>Nota:</strong> Al acceder a esta sección podemos navegar fácilmente entre todas las ubicaciones, accediendo y saliendo de cada ubicación y/o contenedor. En el nivel más bajo, podemos encontrarnos con productos y paquetes. De hecho, es posible inspeccionar el contenido de cada paquete.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modalCaja">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Caja chica</h4>
                </div>
                <div class="modal-body">
                    <p>La sección de caja chica permite llevar un control de distintos conceptos, por ingreso o egreso de dinero.</p>
                    <p>Debemos tener en cuenta que estos ingresos o egresos, son independientes a las compras realizadas por la empresa, y así mismo, son conceptos ajenos a la venta o alquiler.</p>
                    <p>Es decir, estos conceptos resumen gastos o ingresos extra de dinero, independiente al proceso de comercialización de bienes.</p>
                    <p>Podemos encontrar aquí gastos operativos, o administrativos, por ejemplo.</p>
                    <ul>
                        <li>
                            <strong>Asignación:</strong> Cuando el administrador decide ingresar fondos a la caja. Ocurre generalmente a inicio o fin de mes.
                        </li>
                        <li>
                            <strong>Ingreso:</strong> Se decide ingresar dinero a la caja chica por algún motivo especial.
                        </li>
                        <li>
                            <strong>Egreso:</strong> Se decide retirar dinero de la caja chica por algún concepto en particular.
                        </li>
                    </ul>
                    <p>Los motivos de estos movimientos son descritos al momento de registrar un nuevo concepto.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
    <script src="{{ url('/js/home.js') }}"></script>
@endsection
