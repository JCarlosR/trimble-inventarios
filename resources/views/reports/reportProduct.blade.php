@extends('layouts.panel');

@section('title','Reporte de existencias por producto')

@section('content')
    <div class="row">
        @foreach( $products as $product )
            <div class="col col-md-4">
                @if( count($product->items)>0 )
                <div class="panel panel-success">
                    <div class="panel-heading"><h5>{{ $product->name }}</h5></div>
                    <div class="panel-body">
                        @foreach( $product->items as $item)
                            @if($item->state == 'available' AND  $item->package_id == '' )
                                <div class="col col-md-6">{{ $item->series }}</div>
                                <div class="col col-md-6">{{ $item->box->full_name }}</div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection