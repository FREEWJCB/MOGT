@extends('theme.layout')

@section('titulo')
    Crear Empleado
@endsection

@section('contenido')
<section class="content-header">
    <h1>
        <i class="fa fa-heart"></i>
        Registrar Empleado
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('empleado.index')}}">Empleado</a>
        </li>
        <li class="active">Registro</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">

        	<div class="box box-success">
        		<div class="box-header with-border">
                </div>
                <form action="{{ route('empleado.store') }}" method="POST" name="add_empleado" id="form-general" class="form-horizontal">
                	{{ csrf_field() }}
                	<div class="box-body">
                		<div class="form-group">
                			<label for="cedula" class="col-lg-3 control-label requerido">
                				<strong>Cédula:</strong>
                			</label>
                			<div class="col-lg-8">
                				<input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese Cédula...">
                				<span class="text-danger">
                					{{ $errors->first('cedula') }}
                				</span>
							</div>
						</div> <!-- .form-group -->
						<div class="form-group">
							<label for="nombre" class="col-lg-3 control-label requerido">
								<strong>Nombres:</strong>
							</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="nombre" name="nombres" placeholder="Ingrese Nombres...">
								<span class="text-danger">
									{{ $errors->first('nombres') }}
								</span>
							</div>
						</div> <!-- .form-group -->
						<div class="form-group">
							<label for="apellido" class="col-lg-3 control-label requerido">
								<strong>Apellidos:</strong>
							</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="apellido" name="apellidos" placeholder="Ingrese Apellidos..">
								<span class="text-danger">
									{{ $errors->first('apellidos') }}
								</span>
							</div>
						</div> <!-- .form-group -->
						<div class="form-group">
							<div class="maxl">
								<label class="radio inline"> 
									<input type="radio" name="sexo" value="M" checked>
									<span> Masculino </span> 
								</label>
								<label class="radio inline"> 
									<input type="radio" name="sexo" value="F">
									<span>Femenino </span> 
								</label>
							</div> <!-- .input-group -->
						</div> <!-- .form-group -->
						<div class="form-group">
							<label for="telefono" class="col-lg-3 control-label requerido">
								<strong>Telefono:</strong>
							</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" name="telefono" placeholder="0426-7879809" id="telefono">
								<span class="text-danger">
									{{ $errors->first('telefono') }}
								</span>
							</div>
						</div> <!-- .form-group -->
						<div class="form-group">
							<label for="email" class="col-lg-3 control-label requerido">
								<strong>Correo:</strong>
							</label>
							<div class="col-lg-8">
								<input type="email" id="email" name="correo" class="form-control" placeholder="micorreo@gmail.com" value="" />
								<span class="text-danger">
									{{ $errors->first('correo') }}
								</span>
							</div>
						</div> <!-- .form-group -->
						<div class="form-group">
							<label for="cargo_id" class="col-lg-3 control-label requerido">
								<strong>Cargo:</strong>
							</label>
							<div class="col-lg-8">
								<select id="cargo_id" name="cargo_id" class="form-control">
									<option value="">--Seleccione--</option>
									@foreach($cargos as $cargo)
									<option value="{{$cargo['id']}}">
										{{$cargo['nombre']}} 
									</option>
									@endforeach
								</select>
								<span class="text-danger">
									{{ $errors->first('cargo') }}
								</span>
							</div>
						</div> <!-- .form-group -->
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
