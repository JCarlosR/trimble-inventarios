@extends('layouts.panel')

@section('title', 'Productos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Registrar producto</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br>
                    <form id="demo-form2" class="form-horizontal form-label-left" method="post" action="{{url('producto/registrar')}}" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label class="control-label col-md-3c col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="description" name="description" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="last-name">Precio <span class="required">*</span></label>
                            <div class="col-md-3">
                                <input type="number" placeholder="0.00" step="0.01"  id="price" name="price" required="required" class="form-control col-md-4 col-xs-12">
                            </div>

                            <div class="form-group form-inline">
                                <label class="control-label col-md-1" for="last-name">Serie <span class="required">*</span></label>
                                <div class="col-md-3 checkbox">
                                    <input type="checkbox" id="series" name="series" value="1" checked>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="last-name">Marca <span class="required">*</span></label>
                            <div class="col-md-3">
                                <select id="brands" name="brands" class="form-control">
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1" for="last-name">Modelo <span class="required">*</span>
                                </label>
                                <div class="col-md-2">
                                    <select name="exemplars" id="exemplars" class="form-control">
                                        @foreach($exemplars as $exemplar)
                                            <option value="{{$exemplar->id}}">{{$exemplar->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Número de parte <span class="required">*</span></label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" id="part_number" name="part_number" class="form-control col-md-4 col-xs-12">
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="last-name">Color <span class="required">*</span></label>
                                <div class="col-md-2">
                                    <input type="text" id="color" name="color" required="required" class="form-control col-md-4 col-xs-12">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="last-name">Categoría <span class="required">*</span></label>
                            <div class="col-md-3">
                                <select name="categories" id="categories" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1" for="last-name">Subcategoría <span class="required"></span></label>
                                <div class="col-md-2">
                                    <select name="subcategories" id="subcategories" class="form-control">
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Observación<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="comment" id="comment" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6 btn-group col-md-offset-5">
                            <button type="submit" class="btn btn-success btn-lg">Registrar</button>
                            <a href="{{url('/producto')}}" class="btn btn-danger btn-lg">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    <div>
@endsection
<script src="{{ asset('js/products/jquery-1.7.min.js') }}"></script>
<script src="{{ asset('js/products/products.js') }}"></script>