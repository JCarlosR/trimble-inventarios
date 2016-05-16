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
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    @if( $errors->count() > 0 )
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Lo sentimos! </strong>Por favor revise los siguientes errores.
                                    @foreach($errors->all() as $message)
                                        <p>{{$message}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <form id="demo-form2" class="form-horizontal form-label-left" method="post" action="{{url('producto/registrar')}}" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label class="control-label col-md-3c col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" required="required" value="{{ old('name') }}" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Descripción</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="price">Precio <span class="required">*</span></label>
                            <div class="col-md-3">
                                <input type="number" placeholder="0.00" value="{{ old('price') }}"  step="0.01" min="0.00" id="price" name="price" required="required" class="form-control">
                            </div>

                            <div class="form-group form-inline">
                                <label class="control-label col-md-1" for="series">Serie<span class="required">*</span></label>
                                <div class="col-md-3 checkbox">
                                    @if( old('series') != null )
                                        <input type="checkbox" id="series" name="series" checked>
                                    @else
                                        <input type="checkbox" id="series" name="series">
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="">Moneda<span class="required">*</span></label>
                            <div class="col-md-6">
                                @if( old('money') == 2)
                                    <input type="radio" id="money" name="money" value="1" >Soles
                                    <input type="radio" id="money" name="money" value="2" checked>Dólares</label>
                                @else
                                    <input type="radio" id="money" name="money" value="1" checked>Soles
                                    <input type="radio" id="money" name="money" value="2">Dólares</label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="brands">Marca <span class="required">*</span></label>
                            <div class="col-md-3">
                                <select id="brands" name="brands" class="form-control">
                                    @foreach($brands as $brand)
                                        @if( old('brands') == $brand->id)
                                            <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                        @else
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1" for="exemplars">Modelo <span class="required">*</span>
                                </label>
                                <div class="col-md-2">
                                    <select name="exemplars" id="exemplars" class="form-control"> </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="part_number">Número de parte</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" id="part_number" name="part_number" value="{{ old('part_number') }}" class="form-control col-md-4 col-xs-12">
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="color">Color <span class="required">*</span></label>
                                <div class="col-md-2">
                                    <input type="text" id="color" name="color" value="{{ old('color') }}" required="required" class="form-control col-md-4 col-xs-12">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="categories">Categoría <span class="required">*</span></label>
                            <div class="col-md-3">
                                <select name="categories" id="categories" class="form-control">
                                    @foreach($categories as $category)
                                        @if( old('categories') == $category->id )
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1" for="subcategories">Subcategoría</label>
                                <div class="col-md-2">
                                    <select name="subcategories" id="subcategories" class="form-control"></select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">Observación</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="comment" id="comment" class="form-control">{{ old('comment') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-lg">Registrar</button>
                            <a href="{{url('/producto')}}" class="btn btn-danger btn-lg">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/products/jquery-1.7.min.js') }}"></script>
<script src="{{ asset('js/products/products.js') }}"></script>