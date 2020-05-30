@extends('theme.layout')

@section('titulo')
    Empleado
@endsection

@section('contenido')

	<section class="content-header">
		<h1>
			Empleado
			<small>Lista</small>
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="#">
					<i class="fa fa-home"></i> Home
				</a>
			</li>
			<li class="active">Empleado</li>
		</ol>
	</section>
	<!-- <hr class="w-100 bg-danger"> -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4">
						<div class="btn-agregar">
							<a href="{{ route('empleado.create')}}" class="btn btn-success">
								Agregar
							</a>
						</div> <!-- .boton -->
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
						@if (count($empleados) >= 1)
						<table class="table table-responsive table-hover table-bordered">
							<thead class="bg-dark text-light">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Cédula</th>
									<th scope="col">Nombres</th>
									<th scope="col">Apellidos</th>
									<th scope="col">Sexo</th>
									<th scope="col">Telefono</th>
									<th scope="col">Correo</th>
									<th scope="col">Cargo</th>
									<th scope="col" colspan="2">Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($empleados as $empleado)
								<tr>
									<td>{{ $empleado->id }}</td>
									<td>{{ $empleado->cedula }}</td>
									<td>{{ $empleado->nombres }}</td>
									<td>{{ $empleado->apellidos }}</td>
									<td>{{ $empleado->sexo }}</td>
									<td>{{ $empleado->telefono }}</td>
									<td>{{ $empleado->correo }}</td>
									<td>{{ $empleado->cargo->nombre }}</td>
									<td>
										<a href="{{ route('empleado.edit',$empleado->id)}}" class="btn btn-primary">
											<i class="fa fa-edit"></i>Editar
										</a>
									</td>
									<td>
										<form action="{{route('empleado.destroy',$empleado->id)}}" method="post">
											{{ csrf_field() }}
											@method('DELETE')
											<button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de eliminarlo?')">
												<i class="fa fa-times" aria-hidden="true"></i>Eliminar
											</button>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $empleados->links() !!}
						@else
						<h2 class="text-center">
							No hay registros aún.
						</h2>
						@endif
					</div> <!-- .box-body -->
				</div> <!-- .box -->
			</div> <!-- .col-md-12 -->
		</div> <!-- .row -->
	</section> <!-- .content -->
	
@endsection