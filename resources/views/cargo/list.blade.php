@extends('theme.layout')

@section('titulo')
    Cargo
@endsection

@section('contenido')

<section class="content-header">
	<h1>
		Cargo
		<small>Lista</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="#">
				<i class="fa fa-home"></i> Home
			</a>
		</li>
		<li class="active">Cargo</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="btn-agregar">
						<a href="{{ route('cargo.create') }}" class="btn btn-success">
                            Agregar
                        </a>
					</div> <!-- .btn-agregar -->
				</div> <!-- .col-md-4 -->
				<div class="col-md-8">
					<!-- search form -->
					<form action="#" method="get" class="sidebar-form">
						<div class="input-group busqueda">
							<input type="search" name="buscar" class="form-control" placeholder="Buscar ..." aria-label="Buscar"/>
							<div class="input-group-btn">
								<button type="submit" value="Buscar" class="btn btn-success btn-search">
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
					@if (count($cargos) >= 1)
					<table class="table table-hover table-bordered">
						<thead class="bg-dark text-light">
							<tr>
								<th>#</th>
								<th style="width: 55%">Cargo</th>
								<th colspan="2">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cargos as $cargo)
							<tr>
								<td>{{ $cargo->id }}</td>
								<td>{{ $cargo->nombre }}</td>
								<td>
									<a href="{{ route('cargo.edit',$cargo->id)}}" class="btn btn-primary btn-block">
										<i class="fa fa-edit"></i>Editar
									</a>
								</td>
								<td>
									<form action="{{route('cargo.destroy',$cargo->id)}}" method="post">
										{{ csrf_field() }}
										@method('DELETE')
										<button class="btn btn-danger btn-block" type="submit" onclick="return confirm('¿Está seguro de eliminarlo?')">
											<i class="fa fa-times" aria-hidden="true"></i>Eliminar
										</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{!! $cargos->links() !!}
					@else
					<h2 class="text-center">
						No hay registros aún.
					</h2>
					@endif
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</section>

		
@endsection