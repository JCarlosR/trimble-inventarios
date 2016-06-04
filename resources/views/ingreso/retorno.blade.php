@extends('layouts.panel')

@section('title', 'Ingresos')

@section('styles')
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/typeahead.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ingreso por retorno</h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form id="form" class="form-horizontal form-label-left" novalidate="">
                        <!-- React JS -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendors/react/react.min.js') }}"></script>
    <script src="{{ asset('vendors/react/react-dom.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script>
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substrRegex;
                matches = [];
                substrRegex = new RegExp(q, 'i');
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });
                cb(matches);
            };
        };
    </script>
    <script type="text/babel" src="{{ asset('js/entry/retorno.js')}}"></script>
@endsection
