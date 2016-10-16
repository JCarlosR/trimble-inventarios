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
                        <p class="text-muted">El valor 0 significa que no existe detracción. Escriba 0 y guarde, para anular.</p>
                    </div>
                    <div class="form-group">
                        <label for="detraction_date">Fecha de la detracción</label>
                        <input type="date" class="form-control" name="detraction_date" id="detraction_date">
                    </div>
                    <div class="form-group">
                        <label for="voucher">Código del voucher</label>
                        <input type="text" class="form-control" name="voucher" id="voucher">
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="btn-group pull-left">
                        <a class="btn btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Cerrar</a>
                    </div>
                    <div class="btn-group pull-right">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>