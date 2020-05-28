@extends('theme.layout')

@section('contenido')

@include('includes.mensaje')

<section class="content-header">
<h1>
    Alergias
    <small>Lista</small>
</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-9">
                <a href="{{ route('alergia.create') }}" class="btn btn-success mb-2">Agregar</a>
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
                    @if (count($alergias) >= 1)
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th colspan="2" style="width: 2%">Acciones</th>
                            </tr>
                            @foreach($alergias ?? '' as $alergia)
                                <tr>
                                    <td>{{ $alergia->id }}</td>
                                    <td>{{ $alergia->nombre }}</td>
                                    <td>{{ $alergia->descripcion }}</td>
                                    <td>{{ $alergia->tipos->name }}</td>
                                    <td>
                                        <a href="{{ route('alergia.edit', $alergia->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                            Editar
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('alergia.destroy', $alergia->id) }}" method="post">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" 
                                            onclick="return confirm('¿Está seguro de eliminarlo?')">
                                            <i class="fa fa-times"></i>
                                            Eliminar</button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    {!! $alergias ?? ''->links() !!}
                    @else
                        <h3>No hay registros aún.</h3>
                    @endif
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

@endsection
