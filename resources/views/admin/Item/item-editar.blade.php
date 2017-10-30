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
</ul>
</li>
@endsection

@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">  
        <h1>Edição de Perguntas</h1>
        <h5>As perguntas cadastradas serão utilizadas nas avaliaçãoes.</h5>
        <hr>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home </a></li>
            <li><a href="/admin/itens-view"></i> Itens </a></li>
            <li class="active"> Cadastro </li>
        </ol>

        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('item.editar') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $item->id }}" name="idItem">
                    <div class="form-group{{ $errors->has('pergunta') ? ' has-error' : '' }}">
                        <label for="pergunta" class="col-sm-2 control-label">Pergunta</label>
                        <div class="col-sm-10">
                            <input id="pergunta" type="text" class="form-control" name="pergunta" value="{{ $item->pergunta }}" placeholder="Digite a pergunta" required autofocus="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                           <button type="submit" class="btn btn-primary"> Editar </button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </section>        
</div>
@endsection