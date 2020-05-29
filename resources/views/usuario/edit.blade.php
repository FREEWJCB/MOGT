@extends('theme.layout')

@section('titulo')
    Editar Usuario
@endsection

@section('contenido')
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @include('includes.form-error')
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Usuario</h3>
                </div>
                <form action="{{ route('usuario.update',$usuario_info->id)) }}" id="form-general" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-lg-3 control-label requerido">Nombre</label>
                            <div class="col-lg-8">
                              <input type="text" name="name" id="nombre" class="form-control @error('name') is-invalid @enderror" autocomplete="name" autofocus value="{{ $usuario_info->name }}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-lg-3 control-label requerido">{{ __('E-Mail Address') }}</label>
                            <div class="col-lg-8">
                              <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario_info->email }}" required autocomplete="email" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-lg-3 control-label requerido">{{ __('Password') }}</label>
                            <div class="col-lg-8">
                              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="new-password" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-lg-3 control-label requerido">{{ __('Confirm Password') }}</label>
                            <div class="col-lg-8">
                              <input type="password" id="password-confirm" class="form-control @error('password-confirm') is-invalid @enderror" name="password-confirm" value="{{ old('password-confirm') }}" required autocomplete="new-password" required/>
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
