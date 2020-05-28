@extends('theme.layout')

@section('contenido')

@include('includes.mensaje')

<section class="content-header">
<h1>
    Tipos de alergias
    <small>Lista</small>
</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-9">
                <a href="{{ route('tipoAlergia.create') }}" class="btn btn-success mb-2">Agregar</a>
            </div>
            <div class="form-group">
                <form >
                    <input type="text" name="buscarpor" placeholder="Buscar por nombre">
                    <button class="btn btn-primary" type="submit">
                        Buscar
                    </button>
                </form>
            </div>
            <div class="box">
                <div class="box-body no-padding">
                    @if (count($tipos) >= 1)
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 75%">Nombre</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                            @foreach($tipos ?? '' as $tipo)
                                <tr>
                                    <td>{{ $tipo->id }}</td>
                                    <td>{{ $tipo->name }}</td>
                                    <td>
                                        <a href="{{ route('tipoAlergia.edit', $tipo->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                            Editar
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('tipoAlergia.destroy', $tipo->id) }}" method="post">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" 
                                            onclick="return confirm('¿Está seguro de eliminarlo?')">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Eliminar</button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    {!! $tipos ?? ''->links() !!}
                    @else
                        <h3>No hay registros aún.</h3>
                    @endif
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

@endsection