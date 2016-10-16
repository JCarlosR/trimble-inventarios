@extends('layouts.panel')

@section('title', 'Facturas')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-3">
				<div class="form-group">
					Mes
					<select name="month" id="month" class="form-control">
						<option value="1" {{( $month==1 )? 'selected' :'' }}>Enero</option>
						<option value="2" {{( $month==2 )? 'selected' :'' }}>Febrero</option>
						<option value="3" {{( $month==3 )? 'selected' :'' }}>Marzo</option>
						<option value="4" {{( $month==4 )? 'selected' :'' }}>Abril</option>
						<option value="5" {{( $month==5 )? 'selected' :'' }}>Mayo</option>
						<option value="6" {{( $month==6 )? 'selected' :'' }}>Junio</option>
						<option value="7" {{( $month==7 )? 'selected' :'' }}>Julio</option>
						<option value="8" {{( $month==8 )? 'selected' :'' }}>Agosto</option>
						<option value="9" {{( $month==9 )? 'selected' :'' }}>Setiembre</option>
						<option value="10" {{( $month==10)? 'selected':'' }}>Octubre</option>
						<option value="11" {{( $month==11)? 'selected':'' }}>Noviembre</option>
						<option value="12" {{( $month==12)? 'selected':'' }}>Diciembre</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					Fecha inicio
					<input type="date" class="form-control" value={{ $yesterday }}>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					Fecha fin
					<input type="date" class="form-control" value={{ $today }}>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					Listado de facturas según: <br>
					<button type="button" class="btn btn-info "><i class="fa fa-dashboard"></i> Mes</button>
					<button type="button" class="btn btn-warning "><i class="fa fa-dashboard"></i> Fechas</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="x_panel">
	            <div class="x_content table-responsive">
					<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
	                <table class="table table-striped">
	                    <thead>
	                    <tr>
	                        <th>Documento</th>
							<th>Tipo documento</th>
	                        <th>Fecha emisión</th>
	                        <th>Opción</th>
	                    </tr>
	                    </thead>
	                    <tbody id="invoices">
	                    	@foreach( $outputs as $output )
	                        <tr data-id="{{ $output->invoice }}">
	                            <td>{{ $output->invoice }} </td>
								<td>{{ ($output->type_doc=='F')?'Factura':'Boleta'}} </td>
	                            <td>{{ $output->invoice_date }}</td>
	                            <td>
									@if(  $output->income_tax_date== null && $output->general_sales_tax_date == null)
										<button type="submit" class="btn btn-danger" data-invoice="{{ $output->invoice}}">
											<i class="fa fa-trash"></i> Quitar
										</button>
									@else
										@if( $output->income_tax_date != null  )
											<button class="btn btn-primary ">IR</button>
										@endif
											@if( $output->general_sales_tax_date != null  )
												<button class="btn btn-success ">SUNAT</button>
											@endif
									@endif

	                            </td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	              {!! $outputs->render() !!}
	            </div>
	        </div>
		</div>
	</div>

	<div class="row">
		<div class="col col-md-offset-1 col-md-3">
			<a href="{{ url('listar-facturas-declarar-historial')  }}" class="btn btn-dark form-control">
				<i class="fa fa-history"></i> Historial de declaraciones
			</a>
		</div>

		<div class="col col-md-7">
			<div class="col-md-6">
				<button id="ir" class="btn btn-primary  form-control">
					<i class="fa fa-bank"></i>  Declarar Impuesto a la Renta
				</button>
			</div>
			<div class="col-md-6">
				<button id="igv" class="btn btn-success  form-control">
					<i class="fa fa-bank"></i> Declarar IGV para la SUNAT
				</button>
			</div>
		</div>		
	</div>

	<div id="modalQuitar" class="modal fade in">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Quitar factura</h4>
				</div>
				<form action="" method="POST">
					<div class="modal-body">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<input type="hidden" name="id" />
						<div class="form-group">
							<label for="nombreEliminar">¡La factura indicada debe ser declarada en este mes, desea declararla en otra ocasión!</label>
							<input type="text" readonly class="form-control" name="nombreQuitar"/>
						</div>
					</div>
					<div class="modal-footer">
						<div class="btn-group pull-left">
							<button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Cancelar</button>
						</div>
						<div class="btn-group pull-right">
							<button type="submit" id="accept" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Aceptar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script src="{{ asset('js/invoice/index.js') }}"></script>
@endsection
