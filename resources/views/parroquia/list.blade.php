@extends('theme.layout')

@section('contenido')

<section class="content-header">
    <h1>
        Parroquia
        <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li class="active">Parroquia</li>
    </ol>
</section>

@include('includes.mensaje')

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="btn-agregar">
                        <a href="{{ route('parroquia.create') }}" class="btn btn-success">
                            Agregar
                        </a>
                    </div> <!-- .boton -->
                </div> <!-- .col-md-4 -->
                <div class="col-md-8">
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group busqueda">
                            <input type="search" name="buscar" class="form-control" placeholder="Buscar por nombre" aria-label="Buscar"/>
                            <div class="input-group-btn">
                                <button class="btn btn-success btn-search" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div> <!-- /.input-group-btn -->
                        </div> <!-- /.input-group -->
                    </form>
                    <!-- /.search form -->
                </div> <!-- .col-md-8 -->
            </div> <!-- .row -->
            <hr class="raya w-100">
            <div class="box">
                <div class="box-body no-padding">
                    @if (count($parroquias) >= 1)
                    <table class="table table-hover">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Parroquia</th>
                                <th>Municipio</th>
                                <th>Estado</th>
                                <th colspan="2" style="width: 2%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parroquias ?? '' as $parroquia)
                            <tr>
                                <td>{{ $parroquia->id }}</td>
                                <td>{{ $parroquia->parroquia }}</td>
                                <td>{{ $parroquia->municipio }}</td>
                                <td>{{ $parroquia->estado }}</td>
                                <td>
                                    <a href="{{ route('parroquia.edit', $parroquia->id) }}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('parroquia.destroy', $parroquia->id) }}" method="post">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de eliminarlo?')">
                                            <i class="fa fa-times"></i>Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $parroquias ?? ''->links() !!}
                    @else
                    <h2 class="text-center">
                        No hay registros aún.
                    </h2>
                    @endif
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

@endsection
