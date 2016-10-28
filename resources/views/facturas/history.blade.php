@extends('layouts.panel')

@section('title', 'Historial de documentos')

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
					<input type="date" id="inicio" class="form-control" value={{ $yesterday }}>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					Fecha fin
					<input type="date" id="fin" class="form-control" value={{ $today }}>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					Listado de facturas según: <br>
					<button type="button"  id="filter_month" class="btn btn-info "><i class="fa fa-dashboard"></i> Mes</button>
					<button type="button"  id="filter_date" class="btn btn-warning "><i class="fa fa-dashboard"></i> Fechas</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="x_panel">
	            <div class="x_content table-responsive">
	                <table class="table table-hover" id="data">
	                    <thead>
	                    <tr>
	                        <th>Documento</th>
							<th>Tipo documento</th>
	                        <th>Fecha emisión</th>
							<th>Fecha declaración IR</th>
							<th>Fecha declaración IGV</th>
	                    </tr>
	                    </thead>
	                    <tbody id="invoices">
	                    	@foreach( $outputs as $output )
	                        <tr>
	                            <td>{{ $output->invoice }} </td>
								<td>{{ ($output->type_doc=='F')?'Factura':'Boleta' }} </td>
	                            <td>{{ $output->invoice_date }}</td>
								<td>{{ $output->income_tax_date }}</td>
								<td>{{ $output->general_sales_tax_date }}</td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
		</div>
	</div>
	<div class="row text-center">
		<a href="{{ url('listar-facturas-declarar') }}" class="btn btn-danger">
			<i class="fa fa-backward"></i> Volver
		</a>
	</div>

@endsection

@section('scripts')
	<script src="{{ asset('js/pager.js') }}"></script>
	<script src=" {{ asset('js/invoice/history.js') }} "></script>
@endsection