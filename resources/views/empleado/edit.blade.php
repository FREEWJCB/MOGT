@extends('templeate.templeate')

@section('contenido')
	<div class="registro container mt-5 mb-5">
		<div class="bg-dark text-light py-2">
			<h2 class="text-center">
       			Editar Empleado
   			</h2>
		</div>
		<form action="{{ route('empleado.update', $empleado_info->id) }}" method="POST" name="update_empleado" class="formulario-contacto mt-5">
			{{ csrf_field() }}
			@method('PATCH')
		   	<div class="row justify-content-center">
		   		<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label for="cedula">
												<strong>Cédula:</strong>
											</label>
										</div> <!-- .input-group-text -->
									</div> <!-- .input-group-prepend -->
									<input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese Cédula..." value="{{ $empleado_info->cedula }}">
									<span class="text-danger">
										{{ $errors->first('cedula') }}
									</span>
								</div> <!-- .input-group -->
							</div> <!-- .form-group -->
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label for="nombre">
												<strong>Nombres:</strong>
											</label>
										</div> <!-- .input-group-text -->
									</div> <!-- .input-group-prepend -->
									<input type="text" class="form-control" id="nombre" name="nombres" placeholder="Ingrese Nombres..." value="{{ $empleado_info->nombres }}">
									<span class="text-danger">
										{{ $errors->first('nombres') }}
									</span>
								</div> <!-- .input-group -->
							</div> <!-- .form-group -->
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label for="apellido">
												<strong>Apellidos:</strong>
											</label>
										</div> <!-- .input-group-text -->
									</div> <!-- .input-group-prepend -->
									<input type="text" class="form-control" id="apellido" name="apellidos" placeholder="Ingrese Apellidos.." value="{{ $empleado_info->apellidos }}">
									<span class="text-danger">
										{{ $errors->first('apellidos') }}
									</span>
								</div> <!-- .input-group -->
							</div> <!-- .form-group -->

							@if ($empleado_info->sexo=='M')
								@php ($hombre = 'checked')
								@php ($mujer = '')
							@else
								@php ($hombre = '')
								@php ($mujer = 'checked')
							@endif

							<div class="form-group">
								<div class="maxl">
									<label class="radio inline"> 
										<input type="radio" name="sexo" value="M" {{ $hombre }}>
										<span> Masculino </span> 
									</label>
									<label class="radio inline"> 
										<input type="radio" name="sexo" value="F" {{ $mujer }}>
										<span>Femenino </span> 
									</label>
								</div> <!-- .input-group -->
							</div> <!-- .form-group -->
						</div> <!-- .col-md-6 -->
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label for="telefono">
												<strong>Telefono:</strong>
											</label>
										</div> <!-- .input-group-text -->
									</div> <!-- .input-group-prepend -->
									<input class="form-control" type="text" name="telefono" placeholder="0426-7879809" id="telefono" value="{{ $empleado_info->telefono }}">
									<span class="text-danger">
										{{ $errors->first('telefono') }}
									</span>
								</div> <!-- .input-group -->
							</div> <!-- .form-group -->
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label for="email">
												<strong>Correo:</strong>
											</label>
										</div> <!-- .input-group-text -->
									</div> <!-- .input-group-prepend -->
									<input type="email" id="email" name="correo" class="form-control" placeholder="micorreo@gmail.com" value="{{ $empleado_info->correo }}" />
									<span class="text-danger">
										{{ $errors->first('correo') }}
									</span>
								</div> <!-- .input-group -->
							</div> <!-- .form-group -->
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label for="cargo_id">
												<strong>Cargo:</strong>
											</label>
										</div> <!-- .input-group-text -->
									</div> <!-- .input-group-prepend -->
									<select id="cargo_id" name="cargo_id" class="form-control">
										@foreach($cargos as $cargo)
										<option @if($cargo->id == $empleado_info->cargo_id) selected  @endif value="{{$cargo['id']}}">
											{{$cargo['nombre']}} 
										</option>
										@endforeach
									</select>
									<span class="text-danger">
			            				{{ $errors->first('cargo') }}
			            			</span>
								</div> <!-- .input-group -->
							</div> <!-- .form-group -->
							<button type="submit" class="btn btn-outline-success mx-1 px-5">
								Editar
							</button>
							<a href="{{ route('empleado.index') }}" class="btn btn-outline-dark mx-1 px-5">
								Volver
							</a>
						</div> <!-- .col-md-6 -->
					</div> <!-- .row -->
				</div> <!-- .col-md-9 -->
		   	</div> <!-- .row -->
		</form> <!-- .formulario-contacto -->
	</div> <!-- container-->
@endsection
