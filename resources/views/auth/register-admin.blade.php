@extends ('admin.layouts.master')

@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">  
        <h1>Registro de Administrador</h1>
        <hr>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/admins-view"></i> Administradores</a></li>
            <li class="active">Registro</li>
        </ol>

        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-10">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Digite o nome" required autofocus="">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Digite o email" required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-sm-2 control-label">Senha</label>
                        <div class="col-sm-10">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Digite a senha" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>                        
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-sm-2 control-label">Confirmação de senha</label>
                        <div class="col-sm-10">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Digite novamente a senha" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>                        
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="profile_photo" class="col-sm-2 control-label">Foto de perfil</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="profile_photo">
                            <small id="fileHelp" class="form-text text-muted">Escolha a foto do perfil do administrador.</small>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>                        
                    </div>

                    {{-- <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label><input type="checkbox"> Remember me</label>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                           <button type="submit" class="btn btn-primary"> Registrar </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>        
</div>
@endsection