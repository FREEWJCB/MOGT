@extends('theme.layout')

@section('titulo')
    Crear Discapacidad
@endsection

@section('contenido')

<section class="content-header">
    <h1>
        <i class="fa fa-frown-o"></i>
        Registrar Discapacidad
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('discapacidad.index')}}">Discapacidad</a>
        </li>
        <li class="active">Registro</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @include('includes.form-error')
            <div class="box box-success">
                <div class="box-header with-border">
                </div>
                <form action="{{ route('discapacidad.store') }}" id="form-general" class="form-horizontal" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="discapacidad" class="col-lg-3 control-label requerido">Discapacidad</label>
                            <div class="col-lg-8">
                              <input type="text" name="discapacidad" id="discapacidad" class="form-control" value="{{old('discapacidad')}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripciones" class="col-lg-3 control-label requerido">Descripción</label>
                            <div class="col-lg-8">
                              <input type="text" name="descripciones" id="descripciones" class="form-control" value="{{old('descripciones')}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-lg-3 control-label requerido">Tipo</label>
                            <div class="col-lg-8">
                                <select name="tipoDiscapacidad_id" id="tipoDiscapacidad_id" class="form-control">
                                    <option value="">--Seleccione--</option>
                                    @foreach($tipos_d as $tipo)
                                        <option value="{{$tipo['id']}}"> {{$tipo['tipo_d']}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-lg-3"></div>
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection