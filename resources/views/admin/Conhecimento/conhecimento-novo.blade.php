@extends ('admin.layouts.master')

@section ('cadastros')
<li class="active treeview">
  <a href="#">
    <i class="fa fa-dashboard"></i> <span>Cadastros</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('admins.view') }}"><i class="fa fa-circle-o"></i> Administradores</a></li>
    <li><a href="{{ route('noticias.view') }}"><i class="fa fa-circle-o"></i> Notícias </a></li>
    <li><a href="{{ route('conhecimentos.view') }}" style="color: #dd4b39"><i class="fa fa-circle-o"></i> Conhecimentos </a></li>
    <li><a href="{{ route('itens.view') }}"><i class="fa fa-circle-o"></i> Itens </a></li>
    <li><a href="{{ route('pontuacoes.view') }}" ><i class="fa fa-circle-o"></i> Pontuações </a>
  </ul>
</li>
@endsection

@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Cadastro de Conhecimento</h1>
    <hr>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fa fa-dashboard"></i> Home </a></li>
      <li><a href="/admin/conhecimentos-view"></i> Conhecimentos </a></li>
      <li class="active"> Cadastro </li>
    </ol>

    <div class="row">
      <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('conhecimento.cadastrar') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
              <input id="titulo" type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" placeholder="Digite o título" required autofocus="">
            </div>
          </div>

          <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
            <label for="descricao" class="col-sm-2 control-label">Descrição</label>
            <div class="col-sm-10">
              <select class="form-control" id="descricao" name="descricao" required>
                <option value="Back-end">Back-end</option>
                <option value="BD">BD</option>
                <option value="Ferramenta">Ferramenta</option>
                <option value="Front-end">Front-end</option>
              </select>
              @if ($errors->has('descricao'))
              <span class="help-block">
                <strong>{{ $errors->first('descricao') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary"> Cadastrar </button>
           </div>
         </div>
       </form>
     </div>
   </div>
 </section>
</div>
@endsection