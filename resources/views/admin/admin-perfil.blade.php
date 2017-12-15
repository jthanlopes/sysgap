@extends ('admin.layouts.master')

@section ('cadastros')
<li class="treeview">
  <a href="#">
    <i class="fa fa-dashboard"></i> <span>Cadastros</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('admins.view') }}"><i class="fa fa-circle-o"></i> Administradores</a></li>
    <li><a href="{{ route('noticias.view') }}"><i class="fa fa-circle-o"></i> Notícias </a></li>
    <li><a href="{{ route('conhecimentos.view') }}"><i class="fa fa-circle-o"></i> Conhecimentos </a></li>
    <li><a href="{{ route('itens.view') }}"><i class="fa fa-circle-o"></i> Avaliações </a></li>
    <li><a href="{{ route('pontuacoes.view') }}" ><i class="fa fa-circle-o"></i> Pontuações </a>
    </ul>
  </li>
  @endsection


  @section ('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edição de Perfil</h1>
      <hr>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/admins-view"></i> Perfil</a></li>
        <li class="active">{{ Auth::user()->name }}</li>
      </ol>

      <div class="row">
        <div class="col-md-8 col-md-offset-1">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.perfil.editar') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input id="name" type="text" class="form-control" name="name" value="{{ $admin->name }}" placeholder="Digite o nome" required>
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input id="email" type="email" class="form-control" name="email" value="{{ $admin->email }}" placeholder="Digite o email" required>
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
                <input id="password" type="password" class="form-control" name="password" placeholder="Digite a senha" required autofocus="">
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
                <input id="input-1" type="file" class="file" value="{{ $admin->profile_photo }}" name="profile_photo" placeholder="Envie a foto de perfil" />
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
                         <button type="submit" class="btn btn-primary"> Editar Perfil</button>
                       </div>
                     </div>
                   </form>
                 </div>
               </div>
             </section>
           </div>
           @endsection