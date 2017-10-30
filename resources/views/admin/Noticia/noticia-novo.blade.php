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
    <li><a href="{{ route('noticias.view') }}" style="color: #dd4b39"><i class="fa fa-circle-o"></i> Notícias </a></li>
    <li><a href="{{ route('conhecimentos.view') }}"><i class="fa fa-circle-o"></i> Conhecimentos </a></li>
    <li><a href="{{ route('itens.view') }}"><i class="fa fa-circle-o"></i> Itens </a></li>
</ul>
</li>
@endsection

@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">  
        <h1>Cadastro de Notícia</h1>
        <hr>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home </a></li>
            <li><a href="/admin/noticias-view"></i> Notícias </a></li>
            <li class="active"> Cadastro </li>
        </ol>

        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('noticia.cadastrar') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                        <label for="titulo" class="col-sm-2 control-label">Título</label>
                        <div class="col-sm-10">
                            <input id="titulo" type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" placeholder="Digite o título" required autofocus="">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('conteudo') ? ' has-error' : '' }}">
                        <label for="conteudo" class="col-sm-2 control-label">Conteúdo</label>
                        <div class="col-sm-10">
                            <textarea id="conteudo" class="form-control" rows="10" name="conteudo" placeholder="Digite o conteúdo" required></textarea>           
                            @if ($errors->has('conteudo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('conteudo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('data_final') ? ' has-error' : '' }}">
                        <label for="data_final" class="col-sm-2 control-label">Data final</label>
                        <div class="col-sm-10">
                            <input id="data_final" type="date" class="form-control" name="data_final" placeholder="Digite a data final" required>
                            @if ($errors->has('data_final'))
                            <span class="help-block">
                                <strong>{{ $errors->first('data_final') }}</strong>
                            </span>
                            @endif
                        </div>                        
                    </div>

                    <div class="form-group{{ $errors->has('principal') ? ' has-error' : '' }}">
                        <label for="principal" class="col-sm-2 control-label">Principal</label>
                        <div class="col-sm-10">                                         
                          <select class="form-control" id="principal" name="principal" required>
                            <option value="Não">Não</option>
                            <option value="Sim">Sim</option>
                        </select>                    
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