<div id="modalDetraction" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detracción</h4>
            </div>
            <form id="formDetraction" action="{{ url('/salida/detraction') }}" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id" />

                    <div class="form-group">
                        <label for="detraction">Valor de la detracción</label>
                        <input type="number" class="form-control" name="detraction" id="detraction">
                        <p class="text-muted">El valor 0 significa que no existe detracción asociada a la venta.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group pull-left">
                        <button class="btn btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Cerrar</button>
                    </div>
                    <div class="btn-group pull-right">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>