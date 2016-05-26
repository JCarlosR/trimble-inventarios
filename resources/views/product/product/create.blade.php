@extends('layouts.panel')

@section('title', 'Productos')

@section('styles')
    <style>
        .no-resize
        {
            resize: none;
        }
        .inside:focus{
            border: 1px solid #0097cf;
        }
    </style>
@endsection

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

                    <form id="demo-form2" class="form-horizontal form-label-left" method="post" action="{{url('producto/registrar')}}" enctype="multipart/form-data" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Nombre <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" id="name" name="name" required="required" value="{{ old('name') }}" class="form-control inside">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3" for="description">Descripción</label>
                            <div class="col-md-7">
                                <textarea id="description" name="description" class="form-control no-resize inside">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="price">Precio <span class="required">*</span></label>
                            <div class="col-md-3">
                                <input type="number" placeholder="0.00" value="{{ old('price') }}"  step="0.01" min="0.00" id="price" name="price" required="required" class="form-control inside">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-1" for="series">Serie<span class="required">*</span></label>
                                <div class="checkbox col-md-3">
                                    @if( old('series') != null )
                                        <input type="checkbox" id="series" name="series" checked>
                                    @else
                                        <input type="checkbox" id="series" name="series">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="money">Moneda<span class="required">*</span></label>
                            <div class="radio-group col-md-7">
                                @if( old('money') == 2)
                                    <input type="radio" id="money" name="money" value="1" >Soles
                                    <input type="radio" id="money" name="money" value="2" checked>Dólares
                                @else
                                    <input type="radio" id="money" name="money" value="1" checked>Soles
                                    <input type="radio" id="money" name="money" value="2">Dólares
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="brands">Marca</label>
                            <div class="col-md-3">
                                <select id="brands" name="brands" class="form-control inside">
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
                                <label class="control-label col-md-1" for="exemplars">Modelo</label>
                                <div class="col-md-3">
                                    <select name="exemplars" id="exemplars" class="form-control inside"> </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3" for="part_number">Número de parte</label>
                            <div class="col-md-3">
                                <input type="text" id="part_number" name="part_number" value="{{ old('part_number') }}" class="form-control inside">
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1" for="color">Color <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" id="color" name="color" value="{{ old('color') }}" required="required" class="form-control inside">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="categories">Categoría</label>
                            <div class="col-md-3">
                                <select name="categories" id="categories" class="form-control inside">
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
                                <div class="col-md-3">
                                    <select name="subcategories" id="subcategories" class="form-control inside"></select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"  for="image">Imagen</label>
                            <div class="col-md-7">
                                <input type="file" class="form-control inside" name="image" accept="image/*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="comment">Observación</label>
                            <div class="col-md-7">
                                <textarea name="comment" id="comment" class="form-control no-resize inside">{{ old('comment') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Registrar</button>
                            <a href="{{url('/producto')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/products/products.js') }}"></script>
@endsection
