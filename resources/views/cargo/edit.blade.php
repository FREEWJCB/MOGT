@extends('theme.layout')

@section('titulo')
    Editar Cargo
@endsection

@section('contenido')

<section class="content-header">
	<h1>
		Editar Cargo
	</h1>
	<ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('cargo.index')}}">Cargo</a>
        </li>
        <li class="active">
            {{ $cargo_info->nombre }}
        </li>
    </ol>
</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				
				<div class="box box-danger">
					<div class="box-header with-border">
					</div>
					<form action="{{ route('cargo.update', $cargo_info->id) }}" method="POST" name="update_cargo" class="form-horizontal" id="form-general">
						{{ csrf_field() }}
						@method('PATCH')
						<div class="box-body">
							<div class="form-group">
								<label for="cargo" class="col-lg-3 control-label requerido">
									<strong>Cargo:</strong>
								</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="cargo"  name="nombre" placeholder="Ingrese Cargo..." value="{{ $cargo_info->nombre }}">
									<span class="text-danger">
										{{ $errors->first('nombre') }}
									</span>
								</div> <!-- .input-groupo -->
							</div> <!-- .form-groupo -->
							<div class="box-footer">
								<div class="col-lg-3"></div>
								<div class="col-lg-3"></div>
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						</div>
					</form> <!-- .formulario-contacto -->
				</div>
			</div>
		</div>
	</section>
@endsection
