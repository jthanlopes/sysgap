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
    <li><a href="{{ route('conhecimentos.view') }}"><i class="fa fa-circle-o"></i> Conhecimentos </a></li>
    <li><a href="{{ route('itens.view') }}" style="color: #dd4b39"><i class="fa fa-circle-o"></i> Avaliações </a></li>
    <li><a href="{{ route('pontuacoes.view') }}"><i class="fa fa-circle-o"></i> Pontuações </a>
    </ul>
  </li>
  @endsection

  @section ('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Cadastro de Perguntas para as Avaliações</h1>
      <h5>As perguntas cadastradas serão utilizadas nas avaliaçãoes.</h5>
      <hr>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home </a></li>
        <li><a href="/admin/itens-view"></i> Perguntas </a></li>
        <li class="active"> Cadastro </li>
      </ol>

      <div class="row">
        <div class="col-md-8 col-md-offset-1">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('item.cadastrar') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('pergunta') ? ' has-error' : '' }}">
              <label for="pergunta" class="col-sm-2 control-label">Pergunta</label>
              <div class="col-sm-10">
                <input id="pergunta" type="text" class="form-control" name="pergunta" placeholder="Digite a pergunta" required autofocus="">
              </div>
            </div>

            <div class="form-group{{ $errors->has('destino') ? ' has-error' : '' }}">
              <label for="descricao" class="col-sm-2 control-label">Quem vai reponder?</label>
              <div class="col-sm-10">
                <select class="form-control" id="destino" name="destino" required>
                  <option value="Empresas">Empresas</option>
                  <option value="Freelancers">Freelancers</option>
                  <option value="Ambos">Ambos</option>
                </select>
                @if ($errors->has('destino'))
                <span class="help-block">
                  <strong>{{ $errors->first('destino') }}</strong>
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