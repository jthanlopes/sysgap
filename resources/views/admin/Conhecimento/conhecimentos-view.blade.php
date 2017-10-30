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
      <h1>
        Lista de Conhecimentos
      </h1>
      <hr>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Conhecimentos</li>
      </ol>
      <a href="{{ route('conhecimento.show-form-novo') }}" class="btn btn-success btn-sm btn-add">
      ADICIONAR NOVO</a>
      
       <div class="row">
        <div class="col-lg-10 col-md-offset-1 pesquisa-admin-view">          
            <form class="form-inline" role="form" method="POST" action="{{ route('conhecimentos.view.pesquisar') }}">
              {{ csrf_field() }}
              <input id="pesquisa" type="text" class="form-control" name="pesquisa" placeholder="Pesquisar por título">              
              <button type="submit" class="btn btn-primary"> Pesquisar </button>              
            </form>          
        </div>        
      </div>

      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          @if(session()->has('message'))
            <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session()->get('message')['message'] }}
            </div>
          @endif
          <div class="table-responsive">
            <table class="table table-hover table-striped">
              <thead class="thead-inverse">
                <tr>            
                  <th>Título</th>
                  <th>Descrição</th>
                  <th>Nível</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($conhecimentos as $conhecimento)
                  <tr>
                    <td>{{ $conhecimento->titulo }}</td>
                    <td>{{ $conhecimento->descricao }}</td>
                    <td>{{ $conhecimento->nivel }}</td>                 
                    <td>
                      <a href="/admin/conhecimento-view/editar/{{ $conhecimento->id }}" class="btn btn-warning">
                      Editar</a>
                      <a href="/admin/conhecimento-view/excluir/{{ $conhecimento->id }}" class="btn btn-danger">
                      Excluir</a>
                    </td>                 
                  </tr>       
                @endforeach       
                </tbody>
              </table>    
            </div>
        </div>
      </div>
    </section>        
  </div>
@endsection